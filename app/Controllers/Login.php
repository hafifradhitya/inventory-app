<?php

namespace App\Controllers;

class Login extends BaseController {
    public function index(){
        return view('login');
		//password_hash('namapassword', PASSWORD_DEFAULT);
    }
    
    public function submit(){
        $rules =[
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Almat Email Wajib Diisi',
                    'valid_email' => 'Ini Bukan Alamat Email'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong',
                    'min_length' => 'Password Minimal 8 Kata'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $model = model('authmodel');
            $data = $model->where('email', $email)->first();
            log_message('error', json_encode($data));
            if(!empty($data)){
				if(password_verify($password, $data['password'])){
                    session()->set([
                        'user' => $data['id'],
                        'name' => $data['nama'],
                        'email' => $data['email'],
                        //'level' => $data['level'],
                        'islogin' => true
                    ]);
                    $output['url'] = site_url('dashboard');
                    $output['error'] = false;
                }else{
                    $output['error'] = true;
                    $output['message'] = 'Email atau kata sandi tidak cocok!';
                }
                
            }else{
                $output['error'] = true;
                $output['message'] = 'Alamat Email Tidak Ditemukan';
            }
        }else{
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors();
        }
        return $this->response->setJSON($output);
    }
}
    