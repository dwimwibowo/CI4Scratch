<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function __construct(){
        
    }

    public function index()
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-home"></i> Home';
        $data['breadcrumb'] = breadcrumb('home');
        
        return view('portal/home', $data);
    }
}