<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Models\OrderModel;

class Order extends BaseController
{
    private $module = "backend/order";

    public function __construct()
    {
        $this->datatable = new Datatable;
    }

    public function index()
    {
        $data['pageTitle'] = "Orders Listing";
        $data['page'] = "order/view";
        $data['script'] = script_tag('public/assets/admin/custom/orders.js');

        return view('backend', $data);
    }

    public function dataList()
    {
        $post = $this->request->getPost();
        $type = $this->enum->packageType();

        $var['table'] = 'order';
        $var['columnOrder'] = ['order_code', 'order_name', 'order_status', 'order_total', 'order_created', NULL];
        $var['columnSearch'] = ['order_code', 'order_name'];
        $var['order'] = ['order_created' => 'desc'];

        $list = $this->datatable->get_datatables($var);
        $data = [];
        $no = $post['start'];

        foreach ($list as $d)
        {
            $no++;
            $row = [];
            $id = "'".encrypt($d->order_id)."'";

            $row[] = '<a href="'.site_url('backend/order/detail/'.encrypt($d->order_id)).'" class="text-gray-800 text-hover-primary fw-bold">'.$d->order_code.'</a>';
            $row[] = $d->order_name;
            $row[] = badge($d->order_status);
            $row[] = 'Rp '. angka($d->order_total);
            $row[] = date("d/m/Y", strtotime($d->order_created));
            $row[] = '<a href="'.site_url('backend/order').'" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                '.svgIcon('icons/duotune/arrows/arr072.svg', 'svg-icon svg-icon-5 m-0').'</a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">View</a>
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

    public function detail($id = NULL)
    {
        if(!$id) {
            return redirect()->to(site_url('backend/order'));
        }

        $orderModel = new OrderModel;

        $orderId = decrypt($id);
        $order = $orderModel->find($orderId);

        $data['pageTitle'] = "Orders Listing";
        $data['page'] = "order/detail";
        $data['data'] = $order;
        $data['script'] = script_tag('public/assets/admin/custom/orders.js');

        return view('backend', $data);
    }
}
