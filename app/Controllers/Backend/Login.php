<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    private $module = "backend/login";

    public function index()
    {        
        $data['pageTitle'] = "Login Admin";
        $data['script'] = script_tag('public/assets/admin/custom/login.js');

        return view('backend/modules/login/view', $data);
    }

    public function auth()
    {
        $post = $this->request->getPost(['email', 'password']);

        $userModel = new UserModel;
        $data = $userModel->where(['user_email' => $post['email'], 'user_active' => 1])->first();

        if($data)
        {
            $authenticatePassword = $data->user_password == crypt($post['password'], $data->user_password) ? TRUE : FALSE;

            if($authenticatePassword)
            {
                $ses['user_id'] = $data->user_id;
                $ses['user_name'] = $data->user_name;
                $ses['user_email'] = $data->user_email;
                $ses['user_level'] = $data->user_level;
                $ses['isBackendLogin'] = TRUE;

                $this->session->set($ses);

                $json['error'] = false;
                $json['link'] = site_url('backend/home');

                echo json_encode($json);

            }
            else
            {
                $json['error'] = true;
                $json['password'] = "Password is incorrect";
                echo json_encode($json);
            }
        }
        else
        {
            $json['error'] = true;
            $json['email'] = "Email doesn't exist or not active";
            echo json_encode($json);
        }
    }

    public function logout()
    {
        $this->session->remove(['user_id', 'user_name', 'user_email', 'user_level', 'isBackendLogin']);

        return redirect()->to(site_url('backend/login'));
    }
}
