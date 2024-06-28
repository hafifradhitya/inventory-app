<?php

namespace App\Controllers;
use App\Models\PemasokModel;
use Hermawan\DataTables\DataTable;

class PemasokController extends BaseController{
    public function index(){
        return $this->view('master.pemasok');
//        $no = 1;
//        $table = '';
//        $model = new PemasokModel();
//        $suppliers = $model->findAll();
        
//        foreach($suppliers as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['name'].'</td>';
//            $table .= '<td>'.$val['sales'].'</td>';
//            $table .= '<td>'.$val['phone'].'</td>';
//            $table .= '<td>'.$val['address'].'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<button data-id="'.$val['id'].'" data-name="'.$val['name'].'" data-sales="'.$val['sales'].'" data-phone="'.$val['phone'].'" data-address="'.$val['address'].'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('master/pemasok/delete').'" data-redirect="'.site_url('master/pemasok').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
    }
    
    public function list(){
        $model = new PemasokModel();
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('action', function($val){
                    $button = '<button data-id="'.$val->id.'" data-name="'.$val->name.'" data-sales="'.$val->sales.'" data-phone="'.$val->phone.'" data-address="'.$val->address.'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
                    $button .= '<button data-id="'.$val->id.'" data-url="'.site_url('master/pemasok/delete').'" data-redirect="'.site_url('master/pemasok').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->toJson(true);
    }
    
    public function delete(){
        $model = new PemasokModel();
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
                    'required' => 'Nama Perusahaan Tidak Boleh Kosong'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Telepon Tidak Boleh Kosong'
                ]
            ],
            'sales' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Sales Tidak Boleh Kosong'
                ]
            ],
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Perusahaan Tidak Boleh Kosong'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $id = $this->request->getPost('id');
            $model = new PemasokModel();
            $fields['name'] = $this->request->getPost('name');
            $fields['phone'] = $this->request->getPost('phone');
            $fields['sales'] = $this->request->getPost('sales');
            $fields['address'] = $this->request->getPost('address');
            
            if(is_numeric($id)){
                $model->update($id, $fields);
            }else{
                $model->insert($fields);
            }
            
            $output['error'] = false;
            $output['url'] = site_url('master/pemasok');
        }else{
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors(); 
        }
        return $this->response->setJSON($output);
    }
}