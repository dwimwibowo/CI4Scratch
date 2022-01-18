<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
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

    public function index()
    {
        return $this->users();
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
