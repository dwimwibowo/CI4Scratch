<?php
    use App\Models\UserModel;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    
    /* JWT begin */
    function getJWTFromRequest($authenticationHeader): string
    {
        if (is_null($authenticationHeader)) { //JWT is absent
            throw new Exception('Missing or invalid JWT in request');
        }
        //JWT is sent from client in the format Bearer XXXXXXXXX
        return explode(' ', $authenticationHeader)[1];
    }
    
    function validateJWTFromRequest(string $encodedToken = null)
    {
        if (is_null($encodedToken)) { //JWT is absent
            throw new Exception('Missing or invalid JWT in request');
        }

        $decodedToken = JWT::decode($encodedToken, new Key(getenv('JWT_SECRET_KEY'), 'HS256'));
        
        $userModel = new UserModel();
        $userModel->findUserByEmailAddress($decodedToken->email);
    }
    
    function getInfoJWT(string $encodedToken = null)
    {
        if (is_null($encodedToken)) { //JWT is absent
            throw new Exception('Missing or invalid JWT in request');
        }

        $decodedToken = JWT::decode($encodedToken, new Key(getenv('JWT_SECRET_KEY'), 'HS256'));

        $userModel = new UserModel();
        $user = $userModel->findUserByEmailAddress($decodedToken->email);

        $info = (object) array_merge((array)$decodedToken, (array)$user);
        
        return $info;
    }
    
    function getSignedJWT(string $email)
    {
        try
        {
            $userModel = new UserModel();
            $userModel->findUserByEmailAddress($email);

            $issuedAtTime = time();
            $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
            $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
            $payload = [
                'iss' => base_url(),
                'aud' => base_url(),
                'email' => $email,
                'iat' => $issuedAtTime,
                'exp' => $tokenExpiration,
            ];
        
            $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
            return [
                    'status' => 201,
                    'error' => false,
                    'message' => null,
                    'access_token' => $jwt
                ];
        }
        catch (Exception $exception)
        {
            return [
                'status' => 500,
                'error' => true,
                'message' => $exception->getMessage()
            ]; 
        }
    }
    /* JWT end */
    
    function render($core, $view, $data = [])
    {
        echo view($view, $data);
    }

    function breadcrumb($path = 'home')
    {
        static $breadcrumb = array(
            'home' => array('title' => 'Home','link' => null),
            'login' => array('title' => 'Login','link' => null),
            
            'homeAdm' => array('title' => 'Home','link' => 'admin'),
            'userAdm' => array('title' => 'Users','link' => 'admin/user'),
            'userShowAdm' => array('title' => 'Detail User','link' => null),
            'userNewAdm' => array('title' => 'Create User','link' => null),
            'userEditAdm' => array('title' => 'Edit User','link' => null)
        );

        $icon = true;
        $arrPath = explode("|", $path);
        foreach ($arrPath as $key => $value) {
            if (array_key_exists($value,$breadcrumb)){
                if($icon) {
                    $breadcrumb[$value]['title'] = '<i class="fas fa-sitemap text-muted mr-1"></i> '.$breadcrumb[$value]['title'];
                    $icon = false;
                }

                $result[] = $breadcrumb[$value];
            }
        }

        return $result;
    }

    function userRoles()
    {
        $roles = array(
            1 => 'Administrator',
            2 => 'Guest'
        );

        return $roles;
    }

    function msgInfo($title = '', $msg = '', $state = 0)
    {
        switch($state) {
            case 1 : return '<div class="alert alert-success">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                <div class="icon hidden-xs"><i class="fas fa-check-circle"></i></div>
                                <strong>'.$title.'</strong>
                                <br />'.$msg.'
                            </div>';
                break;
            case 2 : return '<div class="alert alert-warning">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                <div class="icon hidden-xs"><i class="fa fa-exclamation-triangle"></i></div>
                                <strong>'.$title.'</strong>
                                <br />'.$msg.'
                            </div>';
                break;
            case 3 : return '<div class="alert alert-danger">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                <div class="icon hidden-xs"><i class="fas fa-times-circle"></i></div>
                                <strong>'.$title.'</strong>
                                <br />'.$msg.'
                            </div>';
                break;
            default: return '<div class="alert alert-info">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                <div class="icon hidden-xs"><i class="fa fa-info-circle"></i></div>
                                <strong>'.$title.'</strong>
                                <br />'.$msg.'
                            </div>';
                break;
        };
    }

    function imgAssets($folderPath, $fileName)
    {
        if(file_exists(FCPATH.$folderPath."/".$fileName))
        {
            return base_url($folderPath."/".$fileName);
        }

        return base_url("assets/img/no-image.jpg");
    }
?>