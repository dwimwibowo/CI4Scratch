<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public $user;

    /**
     * __construct
     * @return void
     */
    public function __construct()
    {
        $this->user = new UserModel();
    }
    
    /**
     * create function to fetch users data
     * @return array on view
     */
    public function users()
    {
        $users = $this->user->findAll();
        return view('users', compact('users'));
    }
}
