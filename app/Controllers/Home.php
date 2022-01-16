<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //return view('welcome_message');

        print_r($this->request);
    }

    public function test()
    {
        //return view('welcome_message');

        echo "Hello world test";
    }
}
