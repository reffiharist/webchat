<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\FeatureModel;

class Feature extends BaseController
{
    private $module = "backend/feature";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "feature/view";
        $data['pageTitle'] = "Feature List";
        $data['script'] = script_tag('public/assets/admin/custom/feature.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->packageType();

        $var['table'] = 'feature';
        $var['columnOrder'] = ['feature_name', 'feature_desc', 'feature_status', NULL];
        $var['columnSearch'] = ['feature_name'];
        $var['order'] = ['feature_id' => 'asc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->feature_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $isActive = $d->feature_status ? 'success' : 'danger';
            $featureActive = $d->feature_status ? 'Publish' : 'Unpublish';
            $featureStatusParam = $d->feature_status ? 0 : 1;
            $featureStatusLabel = $d->feature_status ? 'Unpublish' : 'Publish';

            $dName = "<div class='d-flex align-items-center'>";
            $dName .= "<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'><div class='symbol-label fs-3 bg-light-danger text-danger symbol-custom'>".$d->feature_icon."</div></div>";
            $dName .= "<div class='ms-3'>".$d->feature_name."</div>";
            $dName .= "</div>";

            $row[] = $dName;
            $row[] = substr($d->feature_desc, 0, 100);
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$featureActive."</div>";
            $row[] = '<a href="'.site_url('backend/feature').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="publish('.$id.', '.$featureStatusParam.', '.$urlpublish.')" class="menu-link px-3">'.$featureStatusLabel.'</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="edit('.$d->feature_id.')" class="menu-link px-3">Edit</a>
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
        $post = $this->request->getPost(['name', 'icon', 'desc']);
        $featureModel = new FeatureModel;

        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'icon' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'desc' => $this->validator->showError('desc', 'errorSingle'),
                'icon' => $this->validator->showError('icon', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['feature_name'] = $post['name'];
        $data['feature_desc'] = $post['desc'];
        $data['feature_icon'] = $post['icon'];

        $featureModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $featureModel = new FeatureModel;
        $data = $featureModel->find($post['id']);

        $data_json = [
            'name' => $data->feature_name,
            'desc' => $data->feature_desc,
            'icon' => $data->feature_icon,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'name', 'icon', 'desc']);

        $featureModel = new FeatureModel;

        $main = $featureModel->find($post['id']);

        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'icon' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'desc' => $this->validator->showError('desc', 'errorSingle'),
                'icon' => $this->validator->showError('icon', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['feature_name'] = $post['name'];
        $data['feature_desc'] = $post['desc'];
        $data['feature_icon'] = $post['icon'];

        $featureModel->update($main->feature_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $featureModel = new FeatureModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main data
        $featureModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        $featureModel = new FeatureModel;

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error publish feature' : 'Error unpublish feature';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['feature_status'] = 1;
        } else {
            $data['feature_status'] = 0;
        }

        $featureModel->update($id, $data);

        $message = $status == 1 ? 'Feature has been publish' : 'Feature has been unpublish';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
