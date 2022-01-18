<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function __construct(){
        
    }

    public function index()
    {
        $data = [];
        $data['title'] = "CI4 Home";
        $data['breadcrumb'] = breadcrumb('home');
        
        return render($this, 'admin/home', $data);
    }
}