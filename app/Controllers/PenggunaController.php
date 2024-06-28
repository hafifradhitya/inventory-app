<?php
namespace App\Controllers;
use App\Models\PenggunaModel;
use Hermawan\DataTables\DataTable;

class PenggunaController extends BaseController{
    public function index(){
        return $this->view('master.pengguna');
//        $no = 1;
//        $table = '';
//        $model = new PenggunaModel();
//        $users = $model->findAll();
        
//        foreach($users as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['nama'].'</td>';
//            $table .= '<td>'.$val['email'].'</td>';
//            $table .= '<td>'.$val['status'].'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<button data-id="'.$val['id'].'" data-nama="'.$val['nama'].'" data-email="'.$val['email'].'" data-status="'.$val['status'].'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('master/pengguna/delete').'" data-redirect="'.site_url('master/pengguna').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
    }
    
    public function list(){
        $model = new PenggunaModel();
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('action', function($val){
                    $btn = '<button data-id="'.$val->id.'" data-nama="'.$val->nama.'" data-email="'.$val->email.'" data-status="'.$val->status.'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
                    $btn .= '<button data-id="'.$val->id.'" data-url="'.site_url('master/pengguna/delete').'" data-redirect="'.site_url('master/pengguna').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->toJson(true);
    }
    
    public function delete(){
        $model = new PenggunaModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON([
            'error' => false
        ]);
    }
    
    public function submit(){
        $rules =[
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap Wajib Diisi'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Alamat Email'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $id = $this->request->getPost('id');
            $model = new PenggunaModel();
            $fields['nama'] = $this->request->getPost('nama');
            $fields['email'] = $this->request->getPost('email');
            $fields['status'] = $this->request->getPost('status');
            
            if(is_numeric($id)){
                $model->update($id, $fields);
            }else{
                $model->insert($fields);
            }
            
            $output['error'] = false;
            $output['url'] = site_url('master/pengguna');
        }else{
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors(); 
        }
        return $this->response->setJSON($output);
    }
}