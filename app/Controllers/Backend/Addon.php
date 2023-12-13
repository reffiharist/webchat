<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\AddonModel;

class Addon extends BaseController
{
    private $module = "backend/addon";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "addon/view";
        $data['pageTitle'] = "Addon List";
        $data['type'] = $this->enum->packageType();
        $data['script'] = script_tag('public/assets/admin/custom/addon.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->packageType();

        $var['table'] = 'addon';
        $var['columnOrder'] = ['addon_name', 'addon_number', 'addon_message', 'addon_price', 'addon_type', 'addon_status', NULL];
        $var['columnSearch'] = ['addon_name', 'addon_price', 'addon_type'];
        $var['order'] = ['addon_type' => 'asc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->addon_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $isActive = $d->addon_status ? 'success' : 'danger';
            $addonActive = $d->addon_status ? 'Publish' : 'Unpublish';
            $addonStatusParam = $d->addon_status ? 0 : 1;
            $addonStatusLabel = $d->addon_status ? 'Unpublish' : 'Publish';

            $row[] = $d->addon_name;
            $row[] = $d->addon_number;
            $row[] = angka($d->addon_message);
            $row[] = 'Rp '.angka($d->addon_price);
            $row[] = $type[$d->addon_type];
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$addonActive."</div>";
            $row[] = '<a href="'.site_url('backend/addon').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="publish('.$id.', '.$addonStatusParam.', '.$urlpublish.')" class="menu-link px-3">'.$addonStatusLabel.'</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="edit('.$d->addon_id.')" class="menu-link px-3">Edit</a>
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
        $post = $this->request->getPost(['name', 'price', 'number', 'message', 'type']);
        $addonModel = new AddonModel;

        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'number' => 'required|numeric',
            'message' => 'required|numeric',
            'type' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'price' => $this->validator->showError('price', 'errorSingle'),
                'number' => $this->validator->showError('number', 'errorSingle'),
                'message' => $this->validator->showError('message', 'errorSingle'),
                'type' => $this->validator->showError('type', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['addon_name'] = $post['name'];
        $data['addon_price'] = $post['price'];
        $data['addon_number'] = $post['number'];
        $data['addon_message'] = $post['message'];
        $data['addon_type'] = $post['type'];

        $addonModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $addonModel = new AddonModel;
        $data = $addonModel->find($post['id']);

        $data_json = [
            'name' => $data->addon_name,
            'price' => $data->addon_price,
            'number' => $data->addon_number,
            'message' => $data->addon_message,
            'type' => $data->addon_type,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'name', 'price', 'number', 'message', 'type']);

        $addonModel = new AddonModel;

        $main = $addonModel->find($post['id']);

        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'number' => 'required|numeric',
            'message' => 'required|numeric',
            'type' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'price' => $this->validator->showError('price', 'errorSingle'),
                'number' => $this->validator->showError('number', 'errorSingle'),
                'message' => $this->validator->showError('message', 'errorSingle'),
                'type' => $this->validator->showError('type', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['addon_name'] = $post['name'];
        $data['addon_price'] = $post['price'];
        $data['addon_number'] = $post['number'];
        $data['addon_message'] = $post['message'];
        $data['addon_type'] = $post['type'];

        $addonModel->update($main->addon_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $addonModel = new AddonModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main data
        $addonModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        $addonModel = new AddonModel;

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error publish addon' : 'Error unpublish addon';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['addon_status'] = 1;
        } else {
            $data['addon_status'] = 0;
        }

        $addonModel->update($id, $data);

        $message = $status == 1 ? 'Addon has been publish' : 'Addon has been unpublish';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
