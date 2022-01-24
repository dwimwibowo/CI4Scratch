<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function __construct(){
        
    }

    public function index()
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-home"></i> Home';
        $data['breadcrumb'] = breadcrumb('home');
        
        return render($this, 'admin/home', $data);
    }
}