<?php

namespace App\Controllers;
use App\Models\SatuanModel;
use Hermawan\DataTables\DataTable;

class SatuanController extends BaseController{
    public function index(){
        return $this->view('master.satuan-barang');
//        $no = 1;
//        $table = '';
//        $model = new SatuanModel();
//        $units = $model->findAll();
//        
//        foreach($units as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['name'].'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<button data-id="'.$val['id'].'" data-name="'.$val['name'].'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('master/satuan-barang/delete').'" data-redirect="'.site_url('master/satuan-barang').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
//        return view('layout/header').
//               view('master/satuan-barang', ['table'=>$table]).
//               view('layout/footer');
    }
    
    public function list(){
        $model = new SatuanModel();
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('action', function($val){
                   $btn = '<button data-id="'.$val->id.'" data-name="'.$val->name.'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
                   $btn .= '<button data-id="'.$val->id.'" data-url="'.site_url('master/satuan-barang/delete').'" data-redirect="'.site_url('master/satuan-barang').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                   return $btn;
                })
                ->toJson(true);
    }
    
    public function delete(){
        $model = new SatuanModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON([
            'error' => false
        ]);
    }
    
    public function submit(){
        $rules =[
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Satuan Barang Harus Diisi'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $id = $this->request->getPost('id');
            $model = new SatuanModel();
            $fields['name'] = $this->request->getPost('name');
            
            if(is_numeric($id)){
                $model->update($id, $fields);
            }else{
                $model->insert($fields);
            }
            
            $output['error'] = false;
            $output['url'] = site_url('master/satuan-barang');
        }else{
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors();
        }
        return $this->response->setJSON($output);
    }
}