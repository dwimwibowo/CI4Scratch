<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class JWTAuthenticationFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            helper(['url','cookie','app']);

            if(strpos(current_url(), '/api') !== false)
                $encodedToken = getJWTFromRequest($request->getServer('HTTP_AUTHORIZATION'));
            else
                $encodedToken = get_cookie('access_token');    

            validateJWTFromRequest($encodedToken);

            return $request;
        } catch (Exception $e) {
            helper('url');

            if(strpos(current_url(), '/api') !== false)
            {
                return Services::response()
                    ->setJSON(
                        [
                            'error' => $e->getMessage()
                        ]
                    )
                    ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }
            
            return redirect()->to(base_url().'/login')->with('errors','Access denied, please login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
