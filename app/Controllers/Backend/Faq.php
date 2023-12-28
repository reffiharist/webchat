<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\FaqModel;

class Faq extends BaseController
{
    private $module = "backend/faq";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "faq/view";
        $data['pageTitle'] = "FAQ";
        $data['script'] = script_tag('public/assets/admin/custom/faq.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->packageType();

        $var['table'] = 'faq';
        $var['columnOrder'] = ['question', 'answer', 'faq_status', NULL];
        $var['columnSearch'] = ['question'];
        $var['order'] = ['faq_id' => 'desc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->faq_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $isActive = $d->faq_status ? 'success' : 'danger';
            $faqActive = $d->faq_status ? 'Publish' : 'Unpublish';
            $faqStatusParam = $d->faq_status ? 0 : 1;
            $faqStatusLabel = $d->faq_status ? 'Unpublish' : 'Publish';

            $row[] = $d->question;
            $row[] = $d->answer;
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$faqActive."</div>";
            $row[] = '<a href="'.site_url('backend/faq').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="publish('.$id.', '.$faqStatusParam.', '.$urlpublish.')" class="menu-link px-3">'.$faqStatusLabel.'</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="javascript:void(0)" onclick="edit('.$d->faq_id.')" class="menu-link px-3">Edit</a>
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
        $post = $this->request->getPost(['question', 'answer']);
        $faqModel = new FaqModel;

        $rules = [
            'question' => 'required',
            'answer' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'question' => $this->validator->showError('question', 'errorSingle'),
                'answer' => $this->validator->showError('answer', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['question'] = $post['question'];
        $data['answer'] = $post['answer'];

        $faqModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $faqModel = new FaqModel;
        $data = $faqModel->find($post['id']);

        $data_json = [
            'question' => $data->question,
            'answer' => $data->answer,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'question', 'answer']);

        $faqModel = new FaqModel;

        $main = $faqModel->find($post['id']);

        $rules = [
            'question' => 'required',
            'answer' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'question' => $this->validator->showError('question', 'errorSingle'),
                'answer' => $this->validator->showError('answer', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['question'] = $post['question'];
        $data['answer'] = $post['answer'];

        $faqModel->update($main->faq_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $faqModel = new FaqModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main data
        $faqModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        $faqModel = new FaqModel;

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error publish FAQ' : 'Error unpublish FAQ';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['faq_status'] = 1;
        } else {
            $data['faq_status'] = 0;
        }

        $faqModel->update($id, $data);

        $message = $status == 1 ? 'FAQ has been publish' : 'FAQ has been unpublish';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
