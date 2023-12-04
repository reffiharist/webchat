<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\UserModel;

class User extends BaseController
{
    private $module = "backend/user";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['page'] = "user/view";
        $data['pageTitle'] = "Users Management";
        $data['adminType'] = $this->enum->adminType();
        $data['script'] = script_tag('public/assets/admin/custom/user.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->adminType();

        $var['table'] = 'user';
        $var['columnOrder'] = ['user_name','user_email','user_level', 'user_active', NULL, NULL];
        $var['columnSearch'] = ['user_name','user_email','user_level'];
        $var['order'] = ['user_name' => 'asc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->user_id)."'";
            $urldelete = "'".site_url($this->module.'/delete')."'";
            $urlpublish = "'".site_url($this->module.'/publish')."'";
            $userActive = $d->user_active ? 'Active' : 'Nonactive';
            $isActive = $d->user_active ? 'success' : 'danger';

            $row[] = $d->user_name;
            $row[] = $d->user_email;
            $row[] = $type[$d->user_level];
            $row[] = "<div class='badge badge-light-".$isActive." fw-bold'>".$userActive."</div>";
            $row[] = date("d M Y, H:i");
            // $row[] = '<div class="dropdown">
            //         <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
            //         <ul class="dropdown-menu">
            //             <li><a class="dropdown-item" href="#">Deactive</a></li>
            //             <li><a class="dropdown-item" href="javascript:void(0)" onclick="edit('.$d->user_id.')">Edit</a></li>
            //             <li><a class="dropdown-item" href="javascript:void(0)" onclick="remove('.$id.', '.$urldelete.')">Delete</a></li>
            //         </ul>
            //     </div>';

            $row[] = '<a href="'.site_url('backend/user').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">Edit</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">Delete</a>
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
        $post = $this->request->getPost(['name', 'email', 'password', 'copassword', 'level']);
        $userModel = new UserModel;

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'copassword' => 'required|matches[password]',
            'level' => 'required'
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validator->showError('name', 'errorSingle'),
                'email' => $this->validator->showError('name', 'errorSingle'),
                'password' => $this->validator->showError('password', 'errorSingle'),
                'copassword' => $this->validator->showError('copassword', 'errorSingle'),
                'level' => $this->validator->showError('level', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['user_name'] = $post['name'];
        $data['user_email'] = $post['email'];
        $data['user_password'] = bCrypt($post['password'], 12);
        $data['user_level'] = $post['level'];

        $userModel->insert($data);

        echo json_encode(['error' => false]);
    }

    public function getData()
    {
        $post = $this->request->getPost();

        $userModel = new UserModel;
        $data = $userModel->find($post['id']);

        $data_json = [
            'name' => $data->user_name,
            'email' => $data->user_email,
            'level' => $data->user_level,
        ];

        echo json_encode($data_json);
    }

    public function update()
    {
        $post = $this->request->getPost(['id', 'name', 'email', 'password', 'copassword', 'level']);

        $userModel = new UserModel;

        $main = $userModel->find($post['id']);

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'copassword' => 'matches[password]',
            'level' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'name' => $this->validation->showError('name', 'errorSingle'),
                'email' => $this->validation->showError('email', 'errorSingle'),
                'level' => $this->validation->showError('level', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $data['user_name'] = $post['name'];
        $data['user_email'] = $post['email'];
        $data['user_level'] = $post['level'];

        if(!empty($post['password']) || !empty($post['copassword'])) {
            $data['user_password'] = bCrypt($post['password'], 12);
        }

        $userModel->update($main->user_id, $data);

        echo json_encode(['error' => false]);
    }

    public function delete()
    {
        $post = $this->request->getPost(['id']);
        $userModel = new UserModel;
        $id = decrypt($post['id']);
        
        if(!$post['id']) {
            echo json_encode(['error' => true]);
            exit();
        }

        // Remove main user
        $userModel->delete($id);

        echo json_encode(['error' => false]);
    }

    public function publish()
    {
        $post = $this->request->getPost(['id', 'param']);

        if(!$post['id']) {

            $message = $post['param'] == 1 ? 'Error activate user' : 'Error deactivate user';

            echo json_encode(['error' => true, 'message' => $message]);
            exit();
        }


        $id = decrypt($post['id']);
        $status = $post['param'];

        if($status == 1) {
            $data['user_active'] = 1;
        } else {
            $data['user_active'] = 0;
        }

        $this->model->update($id, $data);

        $message = $status == 1 ? 'User has been actived' : 'User has been deactived';

        echo json_encode(['error' => false, 'message' => $message]);
    }
}
