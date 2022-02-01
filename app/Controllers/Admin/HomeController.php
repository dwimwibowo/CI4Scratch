<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class HomeController extends BaseController
{
    protected $userInfo;
    
    public function __construct(){
        $this->userInfo = getInfoJWT(get_cookie("access_token"));
    }

    public function index()
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-home"></i> Home';
        $data['breadcrumb'] = breadcrumb('home');
        $data['username'] = $this->userInfo->first_name." ".$this->userInfo->last_name;
        $data['userimg'] = base_url()."/assets/uploads/users/".$this->userInfo->user_id.".".$this->userInfo->img_ext;
        $data['userrole'] = userRoles()[$this->userInfo->role_id];

        return render($this, 'admin/home', $data);
    }
}