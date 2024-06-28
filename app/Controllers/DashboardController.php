<?php

namespace App\Controllers;

class DashboardController extends BaseController{
    public function index(){
        return $this->view('dashboard');
    }
    
    public function logout(){
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
