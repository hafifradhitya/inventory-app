<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface{
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }

    public function before(RequestInterface $request, $arguments = null){
        if(!session('islogin')){
            return redirect()->to(site_url('login'));
        }
    }

}