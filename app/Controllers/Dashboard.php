<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data=[
            'title'        => 'Dashboard',
            'total_user'   => 3280,
            'total_order'  => 1240,
            'total_income' => 'Rp 24.500.000',
            'total_produk' => 486,
        ];

        return view('dashboard/index', $data);
    }

}
