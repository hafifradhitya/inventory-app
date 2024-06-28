<?php

namespace App\Controllers;
use App\Models\JenisModel;
use Hermawan\DataTables\DataTable;

class JenisController extends BaseController{
    public function index(){
        return $this->view('master.jenis-barang');
//        $no = 1;
//        $table = '';
//        $model = new JenisModel();
//        $types = $model->findAll();
//        
//        foreach($types as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['name'].'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<button data-id="'.$val['id'].'" data-name="'.$val['name'].'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('master/jenis-barang/delete').'" data-redirect="'.site_url('master/jenis-barang').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
//        return view('layout/header').
//               view('master/jenis-barang', ['table'=>$table]).
//               view('layout/footer');
    }
    
    public function list(){
        $model = new JenisModel();
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('action', function($val){
                    $button = '<button data-id="'.$val->id.'" data-name="'.$val->name.'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
                    $button .= '<button data-id="'.$val->id.'" data-url="'.site_url('master/jenis-barang/delete').'" data-redirect="'.site_url('master/jenis-barang').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->toJson(true);
    }
    
    public function delete(){
        $model = new JenisModel();
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
                    'required' => 'Nama Jenis Barang Harus Diisi'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $id = $this->request->getPost('id');
            $model = new JenisModel();
            $fields['name'] = $this->request->getPost('name');
            
            if(is_numeric($id)){
                $model->update($id, $fields);
            }else{
                $model->insert($fields);
            }
            
            $output['error'] = false;
            $output['url'] = site_url('master/jenis-barang');
        }else{
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors();
        }
        return $this->response->setJSON($output);
    }
}