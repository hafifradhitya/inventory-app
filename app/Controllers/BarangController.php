<?php
namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\JenisModel;
use App\Models\SatuanModel;
use Hermawan\DataTables\DataTable;

class BarangController extends BaseController{
    public function index(){
        
        $unitModel = new SatuanModel();
        $typesModel = new JenisModel();
        
        return $this->view('master.barang', [
                    'units'=> $unitModel->findAll(),
                    'types'=> $typesModel->findAll()
                ]);
    }
    
    public function list(){
        $model = new BarangModel();
        $products = $model->list();
        // log_message('error', json_encode($products->findAll()));
        return DataTable::of($products)
                ->addNumbering('no')
                ->add('action', function($row){
                    $btn = '<button data-id="'.$row->id.'" data-name="'.$row->name.'" data-unit_id="'.$row->unit_id.'" data-type_id="'.$row->type_id.'" class="btn btn-sm btn-edit btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;';
                    $btn .= '<button data-id="'.$row->id.'" data-url="'.site_url('master/barang/delete').'" data-redirect="'.site_url('master/barang').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->toJson(true);
    }
    
    public function delete(){
        $model = new BarangModel();  
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
                    'required' => 'Nama Tidak Boleh Kosong'
                ]
            ],
            'unit_id' => [
                'rules' => 'required',
                'errors' => [
                    'rquired' => 'Unit Tidak Boleh Kosong'
                ]
            ],
            'type_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Harus Diisi'
                ]
            ]
        ];
        
        if ($this->validate($rules)){
            $id = $this->request->getPost('id');
            $model = new BarangModel();
            $fields['name'] = $this->request->getPost('name');
            $fields['unit_id'] = $this->request->getPost('unit_id');
            $fields['type_id'] = $this->request->getPost('type_id');
            
            if(is_numeric($id)){
                $model->update($id, $fields);
            }else{
                $model->insert($fields);
            }
            
            $output['error'] = false;
            $output['url'] = site_url('master/barang');
        }else {
            $output['error'] = true;
            $output['message'] = $this->validator->listErrors();
        }
        return $this->response->setJSON($output);
    }
}