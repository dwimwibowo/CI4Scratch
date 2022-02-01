<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

class UserController extends BaseController
{
    protected $helpers = ['form'];
    
    public function index()
    {
        //
    }

    public function login($data = null)
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-user-friends"></i> Login';
        $data['cardTitle'] = '<i class="nav-icon far fa-list-alt"></i> List User';
        $data['breadcrumb'] = breadcrumb('home|login');

        if($this->request->getMethod() == "post")
        {
            $input = $this->request->getPost();
            
            $validationRules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Invalid login credentials provided'
                ]
            ];

            if (! $this->validate($validationRules, $errors))
            {
                $data['errors'] = $this->validator->getErrors();
            }
            else
            {
                $response = getSignedJWT($input['email']);

                if(!$response['error'])
                {
                    set_cookie("access_token", $response['access_token'], getenv('JWT_TIME_TO_LIVE'));
                
                    return redirect()->to("/admin")->withCookies();
                }
                else
                    $data['errors'] = $response['message'];
            }
        }

        return view('portal/login', $data);
    }
}