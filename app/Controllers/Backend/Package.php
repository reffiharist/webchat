<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\PackageModel;

class Package extends BaseController
{
    private $module = "backend/package";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "package/view";
        $data['pageTitle'] = "Package List";
        $data['packageType'] = $this->enum->packageType();
        $data['script'] = script_tag('public/assets/admin/custom/package.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->packageType();

        $var['table'] = 'package';
        $var['columnOrder'] = ['package_name', 'package_price', 'package_type', 'package_status', NULL];
        $var['columnSearch'] = ['package_name', 'package_price', 'package_type'];
        $var['order'] = ['package_type' => 'asc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->package_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $isActive = $d->package_status ? 'success' : 'danger';
            $packageActive = $d->package_status ? 'Publish' : 'Unpublish';
            $packageStatusParam = $d->package_status ? 0 : 1;
            $packageStatusLabel = $d->package_status ? 'Unpublish' : 'Publish';

            $row[] = $d->package_name;
            $row[] = 'Rp '.angka($d->package_price);
            $row[] = $type[$d->package_type];
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$packageActive."</div>";
            $row[] = '<a href="'.site_url('backend/package').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="publish('.$id.', '.$packageStatusParam.', '.$urlpublish.')" class="menu-link px-3">'.$packageStatusLabel.'</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="edit('.$d->package_id.')" class="menu-link px-3">Edit</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="remove('.$id.', '.$urldelete.')" class="menu-link px-3">Delete</a>
                    </div>
                </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->datatable->count_all($var),
            "recordsFiltered" => $this->datatable->count_filtered($var),
            "data" => $data,
        );
 
        return json_encode($output);
    }

    public function create()
    {
        $post = $this->request->getPost(['name', 'price', 'type', 'desc']);
        $packageModel = new PackageModel;

        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'desc' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'price' => $this->validator->showError('price', 'errorSingle'),
                'type' => $this->validator->showError('type', 'errorSingle'),
                'desc' => $this->validator->showError('desc', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['package_name'] = $post['name'];
        $data['package_price'] = $post['price'];
        $data['package_type'] = $post['type'];
        $data['package_desc'] = $post['desc'];

        $packageModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $packageModel = new PackageModel;
        $data = $packageModel->find($post['id']);

        $data_json = [
            'name' => $data->package_name,
            'price' => $data->package_price,
            'type' => $data->package_type,
            'desc' => $data->package_desc,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'name', 'price', 'type', 'desc']);

        $packageModel = new PackageModel;

        $main = $packageModel->find($post['id']);

        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'desc' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'price' => $this->validator->showError('price', 'errorSingle'),
                'type' => $this->validator->showError('type', 'errorSingle'),
                'desc' => $this->validator->showError('desc', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['package_name'] = $post['name'];
        $data['package_price'] = $post['price'];
        $data['package_type'] = $post['type'];
        $data['package_desc'] = $post['desc'];

        $packageModel->update($main->package_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $packageModel = new PackageModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main data
        $packageModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        $packageModel = new PackageModel;

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error publish package' : 'Error unpublish package';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['package_status'] = 1;
        } else {
            $data['package_status'] = 0;
        }

        $packageModel->update($id, $data);

        $message = $status == 1 ? 'Package has been publish' : 'Package has been unpublish';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
