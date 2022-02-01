<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends ResourceController
{
    protected $users;

    /**
     * __construct
     * @return void
     */
    public function __construct()
    {
        helper('app');
        
        $this->users = new UserModel();
    }
    
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $data = $this->users->findAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Data Found",
            'data' => $data,
        ];
        return $this->respond($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $data = $this->users->where(['user_id' => $id])->first();
      
        if ($data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Data Found",
                'data' => $data,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $data = $this->users->find($id);

        if ($data) {

            $this->users->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Data Deleted",
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
    
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        if($this->request->getMethod() == "post")
        {
            $input = $this->request->getVar();
            
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
                return $this->failValidationErrors($this->validator->getErrors());
            }
            else
            {
                $response = getSignedJWT($input->email);

                if(!$response['error'])
                    return $this->respondCreated($response);
                else
                    return $this->failServerError($response['message']);
            }
        }

        return $this->failUnauthorized();
    }
}
