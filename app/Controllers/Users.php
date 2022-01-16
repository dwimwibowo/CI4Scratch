<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Users extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        echo "Hello Users";

        print_r($this->userModel);
    }
}
