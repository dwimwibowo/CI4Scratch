<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Files\File;

class UserController extends BaseController
{
    protected $helpers = ['form','session','filesystem'];
    protected $users;
    protected $userImgFolder = "assets/uploads/users/";

    /**
     * __construct
     * @return void
     */
    public function __construct()
    {
        $this->users = new UserModel();
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->list();
    }
    
    /**
     * create function to fetch users data
     * @return array on view
     */
    public function list($data = null)
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-user-friends"></i> Users';
        $data['cardTitle'] = '<i class="nav-icon far fa-list-alt"></i> List User';
        $data['breadcrumb'] = breadcrumb('homeAdm|userAdm');
        $data['userImgFolder'] = $this->userImgFolder;
        $data['users'] = $this->users->findAll();
        
        return view('admin/user/list', $data);
    }

    public function show($id)
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-user-friends"></i> Users';
        $data['cardTitle'] = '<i class="nav-icon fas fa-search"></i> Detail User';
        $data['breadcrumb'] = breadcrumb('homeAdm|userAdm|userShowAdm');
        $data['roles'] = userRoles();
        $data['userImgFolder'] = $this->userImgFolder;
        $data['user'] = $this->users->find($id);

        return view('admin/user/show', $data);
    }

    public function new($data = null)
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-user-friends"></i> Users';
        $data['cardTitle'] = '<i class="nav-icon fas fa-pencil-alt"></i> Create User';
        $data['breadcrumb'] = breadcrumb('homeAdm|userAdm|userNewAdm');
        $data['roles'] = userRoles();
        
        return view('admin/user/new', $data);
    }

    public function create()
    {
        if($this->request->getMethod() == "post"){
            $data = $this->request->getPost();

            $validationRules = [
                'firstName' => ['label' => 'First Name', 'rules' => 'required'],
                'lastName' => ['label' => 'Last Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'],
                'password' => ['label' => 'Password', 'rules' => 'required|min_length[3]'],
                'confirm' => ['label' => 'Password Confirmation', 'rules' => 'required|matches[password]'],
                'imgFile' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[imgFile]'
                        . '|is_image[imgFile]'
                        . '|mime_in[imgFile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[imgFile,100]'
                        . '|max_dims[imgFile,1024,768]',
                ],
                'role' => ['label' => 'User Role', 'rules' => 'required|selectValidation']
            ];

            if (! $this->validate($validationRules))
            {
                $data['errors'] = $this->validator->getErrors();
                
                goto finish;
            }

            $img = $this->request->getFile('imgFile');

            if (!$img->hasMoved())
            {
                $dataForm = [
                    'first_name' => $data['firstName'],
                    'last_name' => $data['lastName'],
                    'email' => $data['email'],
                    'img_ext' => $img->getExtension(),
                    'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                    'role_id' => $data['role'],
                ];
                
                $this->users->db->transBegin();
                try {
                    if ($this->users->insert($dataForm) === false) {
                        $data['errors'] = $this->users->errors();
                        goto finish;
                    }

                    $user_id = $this->users->getInsertID();

                    if(file_exists(FCPATH.$this->userImgFolder.$user_id.".".$img->getExtension()))
                    {
                        $oldFile = new File(FCPATH.$this->userImgFolder.$user_id.".".$img->getExtension());
                        $oldFile->move(FCPATH.$this->userImgFolder."backup/",$oldFile->getBasename($img->getExtension()).date("YmdHms").".".$img->getExtension());
                    }

                    $img->move(FCPATH.$this->userImgFolder,$user_id.".".$img->getExtension());

                    $this->users->db->transCommit();

                    session()->setFlashData('msgInfo','Data saved successfully, click <a href="'.base_url().'/admin/user/'.$this->users->getInsertID().'" class="alert-link">here</a> for detail.');

                    return redirect()->to('admin/user/new');
                }
                catch (\Exception $e)
                {
                    $data['errors'] = $e;
                    $this->users->db->transRollback();
                }
            }
            else
            {
                $data = ['errors' => 'The file has already been moved.'];
            }
        }

        finish:
        return $this->new($data);
    }

    public function edit($id, $data = null)
    {
        $data['pageTitle'] = '<i class="nav-icon fas fa-user-friends"></i> Users';
        $data['cardTitle'] = '<i class="nav-icon fas fa-search"></i> Update User';
        $data['breadcrumb'] = breadcrumb('homeAdm|userAdm|userEditAdm');
        $data['roles'] = userRoles();
        $data['userImgFolder'] = $this->userImgFolder;
        $data['user'] = $this->users->find($id);
        
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $data = null;
        
        if($this->request->getMethod() == "put"){
            $data = $this->request->getPost();

            $validationRules = [
                'firstName' => ['label' => 'First Name', 'rules' => 'required'],
                'lastName' => ['label' => 'Last Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email,user_id,'.$id.']'],
                //'password' => ['label' => 'Password', 'rules' => 'required'], //|min_length[10]
                'confirm' => ['label' => 'Password Confirmation', 'rules' => 'matches[password]'],
                'role' => ['label' => 'User Role', 'rules' => 'required|selectValidation']
            ];

            $dataForm = [
                'first_name' => $data['firstName'],
                'last_name' => $data['lastName'],
                'email' => $data['email'],
                'role_id' => $data['role'],
            ];

            $img = $this->request->getFile('imgFile');
            
            if($img->getPath() !== "")
            {
                $validationRules['imgFile'] = [
                    'label' => 'Image File',
                    'rules' => 'uploaded[imgFile]'
                        . '|is_image[imgFile]'
                        . '|mime_in[imgFile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[imgFile,100]'
                        . '|max_dims[imgFile,1024,768]',
                ];

                if ($img->hasMoved())
                {
                    $data['errors'] = 'The file has already been moved.';

                    goto finish;
                }

                $dataForm['img_ext'] = $img->getExtension();
            }

            if($data['password'] !== '')
            {
                $validationRules['password'] = ['label' => 'Password', 'rules' => 'min_length[3]'];
                
                $dataForm['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            if (!$this->validate($validationRules))
            {
                $data['errors'] = $this->validator->getErrors();
                
                goto finish;
            }

            $this->users->db->transBegin();
            try {
                if ($this->users->update($id, $dataForm) === false) {
                    $data['errors'] = $this->users->errors();    
                    goto finish;
                }

                if($img->getPath() !== "")
                {
                    if(file_exists(FCPATH.$this->userImgFolder.$id.".".$img->getExtension()))
                    {
                        $oldFile = new File(FCPATH.$this->userImgFolder.$id.".".$img->getExtension());
                        $oldFile->move(FCPATH.$this->userImgFolder."backup/",$oldFile->getBasename($img->getExtension()).date("YmdHms").".".$img->getExtension());
                    }

                    $img->move(FCPATH.$this->userImgFolder,$id.".".$img->getExtension());
                }

                $this->users->db->transCommit();

                session()->setFlashData('msgInfo','Data saved successfully.');

                return redirect()->to('admin/user/edit/'.$id);
            }
            catch (\Exception $e)
            {
                $data['errors'] = $e;
                $this->users->db->transRollback();
            }
        }

        finish:
        return $this->edit($id, $data);
    }

    public function delete($id)
    {
        $data = null;

        $this->users->db->transBegin();
        try {
            $this->users->delete($id);
            
            $this->users->db->transCommit();

            session()->setFlashData('msgInfo','Data deleted successfully.');

            return redirect()->to('admin/user');
        }
        catch (\Exception $e)
        {
            $data['errors'] = $e;
            $this->users->db->transRollback();
        }
        
        finish:
        return $this->list($data);
    }
    
    public function remove()
    {
        $data = null;

        if($this->request->getMethod() == "post")
        {
            $data = $this->request->getPost();

            if(isset($data['chkData']))
            {
                $this->users->db->transBegin();
                try {
                    //var_dump([join(",",$data['chkData'])]);

                    $this->users->delete($data['chkData']);

                    $this->users->db->transCommit();

                    session()->setFlashData('msgInfo','Data deleted successfully.');

                    return redirect()->to('admin/user');
                }
                catch (\Exception $e)
                {
                    $data['errors'] = $e;
                    $this->users->db->transRollback();
                }
            }
            else
            {
                $data['errors'] = 'Please choose data to deleted.';
            }
        }

        return $this->list($data);
    }

    public function logout()
    {
        delete_cookie("access_token");

        return redirect()->to("/login");
    }
}