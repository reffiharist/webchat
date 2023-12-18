<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BackendLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = service('session');

        if(empty($session->get('isBackendLogin'))) {
            return redirect()->to(site_url('backend/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $session = service('session');

        if(!empty($session->get('isBackendLogin'))) {
            return redirect()->to(site_url('backend/home'));
        }
    }
}