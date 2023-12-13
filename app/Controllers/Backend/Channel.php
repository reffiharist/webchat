<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\ChannelModel;

class Channel extends BaseController
{
    private $module = "backend/channel";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "channel/view";
        $data['pageTitle'] = "Payment Channel";
        $data['category'] = $this->enum->paymentMethod();
        $data['script'] = script_tag('public/assets/admin/custom/channel.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->paymentMethod();

        $var['table'] = 'channel';
        $var['columnOrder'] = ['channel_code', 'channel_name', 'channel_fee', 'channel_feeadd', 'channel_category', 'channel_status', NULL];
        $var['columnSearch'] = ['channel_name', 'channel_code', 'channel_category'];
        $var['order'] = ['channel_category' => 'asc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->channel_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $isActive = $d->channel_status ? 'success' : 'danger';
            $channelActive = $d->channel_status ? 'Publish' : 'Unpublish';
            $channelStatusParam = $d->channel_status ? 0 : 1;
            $channelStatusLabel = $d->channel_status ? 'Unpublish' : 'Publish';

            $row[] = $d->channel_code;
            $row[] = $d->channel_name;
            $row[] = $d->channel_fee_type == 'nominal' ? 'Rp '.angka($d->channel_fee) : ($d->channel_fee*100)."%";
            $row[] = $d->channel_feeadd_type == 'nominal' ? 'Rp '.angka($d->channel_feeadd) : ($d->channel_feeadd*100)."%";
            $row[] = !empty($d->channel_category) ? $type[$d->channel_category] : "";
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$channelActive."</div>";
            $row[] = '<a href="'.site_url('backend/addon').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="publish('.$id.', '.$channelStatusParam.', '.$urlpublish.')" class="menu-link px-3">'.$channelStatusLabel.'</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="edit('.$d->channel_id.')" class="menu-link px-3">Edit</a>
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
        $post = $this->request->getPost(['name', 'code', 'fee', 'feeadd', 'fee_type', 'feeadd_type', 'category']);
        $channelModel = new ChannelModel;

        $rules = [
            'code' => 'required',
            'name' => 'required',
            'fee' => 'required|numeric',
            'feeadd' => 'required|numeric',
            'category' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'code' => $this->validator->showError('code', 'errorSingle'),
                'fee' => $this->validator->showError('fee', 'errorSingle'),
                'feeadd' => $this->validator->showError('feeadd', 'errorSingle'),
                'category' => $this->validator->showError('category', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['channel_code'] = $post['code'];
        $data['channel_name'] = $post['name'];
        $data['channel_fee'] = isset($post['fee_type']) ? ($post['fee']/100) : $post['fee'];
        $data['channel_feeadd'] = isset($post['feeadd_type']) ? ($post['feeadd']/100) : $post['feeadd'];
        $data['channel_fee_type'] = isset($post['fee_type']) ? 'percent' : 'nominal';
        $data['channel_feeadd_type'] = isset($post['feeadd_type']) ? 'percent' : 'nominal';
        $data['channel_category'] = $post['category'];

        $channelModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $channelModel = new ChannelModel;
        $data = $channelModel->find($post['id']);

        $data_json = [
            'code' => $data->channel_code,
            'name' => $data->channel_name,
            'fee' => $data->channel_fee_type == 'nominal' ? $data->channel_fee+0 : ($data->channel_fee*100),
            'feeadd' => $data->channel_feeadd_type == 'nominal' ? $data->channel_feeadd+0 : ($data->channel_feeadd*100),
            'fee_type' => $data->channel_fee_type,
            'feeadd_type' => $data->channel_feeadd_type,
            'category' => $data->channel_category,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'name', 'code', 'fee', 'feeadd', 'fee_type', 'feeadd_type', 'category']);

        $channelModel = new ChannelModel;

        $main = $channelModel->find($post['id']);

        $rules = [
            'code' => 'required',
            'name' => 'required',
            'fee' => 'required|numeric',
            'feeadd' => 'required|numeric',
            'category' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'code' => $this->validator->showError('code', 'errorSingle'),
                'fee' => $this->validator->showError('fee', 'errorSingle'),
                'feeadd' => $this->validator->showError('feeadd', 'errorSingle'),
                'category' => $this->validator->showError('category', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['channel_code'] = $post['code'];
        $data['channel_name'] = $post['name'];
        $data['channel_fee'] = isset($post['fee_type']) ? ($post['fee']/100) : $post['fee'];
        $data['channel_feeadd'] = isset($post['feeadd_type']) ? ($post['feeadd']/100) : $post['feeadd'];
        $data['channel_fee_type'] = isset($post['fee_type']) ? 'percent' : 'nominal';
        $data['channel_feeadd_type'] = isset($post['feeadd_type']) ? 'percent' : 'nominal';
        $data['channel_category'] = $post['category'];

        $channelModel->update($main->channel_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $channelModel = new ChannelModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main data
        $channelModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        $channelModel = new ChannelModel;

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error publish addon' : 'Error unpublish addon';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['channel_status'] = 1;
        } else {
            $data['channel_status'] = 0;
        }

        $channelModel->update($id, $data);

        $message = $status == 1 ? 'Addon has been publish' : 'Addon has been unpublish';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
