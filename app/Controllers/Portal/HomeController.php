<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function __construct(){
        
    }

    public function index()
    {
        $data = [];
        $data['title'] = "CI4 Home";
        $data['breadcrumb'] = breadcrumb('home');
        
        return render($this, 'portal/home', $data);
    }
}