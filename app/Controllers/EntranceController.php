<?php
namespace App\Controllers;
use App\Models\EntranceModel;
use App\Models\PemasokModel;
use App\Models\BarangModel;
use App\Models\EntranceDetailModel;
use Hermawan\DataTables\DataTable;

class EntranceController extends BaseController{
    public function index(){
        return $this->view('entrance.list');
//        $no = 1;
//        $table = '';
//        $model = new EntranceModel();
//        $model->select('entrances.*, a.name as supplier');
//        $model->join('suppliers a', 'entrances.supplier_id = a.id');
//        $model->orderBy('entrances.id', 'desc');
//        $suppliers = $model->findAll();
        
//        foreach($suppliers as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['code'].'</td>';
//            $table .= '<td>'.date('d-m-Y', strtotime($val['date'])).'</td>';
//            $table .= '<td>'.$val['supplier'].'</td>';
//            $table .= '<td>'. number_format($val['total'], 0, '.', '.').'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<a href="'.site_url('barang-masuk/detail/'.$val['id']).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('barang-masuk/delete').'" data-redirect="'.site_url('barang-masuk').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
    }
    
    public function list(){
        $model = new EntranceModel();
        //$entrances = $model->list();
        //log_message('error', json_encode($entrances));
        return DataTable::of($model->list())
                ->addNumbering('no')
                ->add('action', function($val){
                    $btn = '<a href="'.site_url('barang-masuk/detail/'.$val->id).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $btn .= '<button data-id="'.$val->id.'" data-url="'.site_url('barang-masuk/delete').'" data-redirect="'.site_url('barang-masuk').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->edit('date', function($row){
                    return date('d-m-Y', strtotime($row->date));
                })
                ->edit('total', function($row){
                    return number_format($row->total, 0, '.', '.');
                })
                ->toJson(true);
    }
    
    public function listDetail(){
        $model = new EntranceDetailModel();
        $model->list($this->request->getPost('entrance'));
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('total', function($row){
                    return number_format($row->price*$row->qty, 0, '.', '.');
                })
                ->edit('product', function($row){
                    return $row->product;
                })
                ->edit('qty', function($row){
                    return number_format($row->qty, 0, '.', '.');
                })
                ->edit('unit', function($row){
                    return $row->unit;
                })
                ->toJson(true);
    }
    
    public function add(){
        $model = new EntranceModel();
        $supplier = new PemasokModel();
        $barang = new BarangModel();
        
        return $this->view('entrance.add', [
            'code' => $model->code(),
            'supplier' => $supplier->findAll(),
            'barang' => $barang->list()->findAll()
        ]);
    }
    
    public function delete(){
        $model = new EntranceModel();
        $detail = new EntranceDetailModel();
        $id = $this->request->getPost('id');
        $model->delete($id);
        $detail->where('entrance_id', $id)->delete();
        return $this->response->setJSON([
            'error' => false
        ]);
    }
    
    public function detail($id){
//        $no = 1;
//        $table = '';
//        $model = new EntranceDetailModel();
//        $suppliers = $model->list($id)->findAll();
//        
//        foreach($suppliers as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['product'].'</td>';
//            $table .= '<td style="text-align: right;">'.$val['qty'].'</td>';
//            $table .= '<td>'.$val['unit'].'</td>';
//            $table .= '<td style="text-align: right;">'. number_format($val['price'], 0, '.', '.').'</td>';
//            $table .= '<td style="text-align: right;">'. number_format($val['price']*$val['qty'], 0, '.', '.').'</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
//        return view('layout/header').
//               view('entrance/detail', ['table'=>$table]).
//               view('layout/footer');
        return $this->view('entrance.detail', [
            'entrance' => $id
        ]);
    }

    public function submit(){
        $model = new EntranceModel();
        $detail = new EntranceDetailModel();
        
        try {
            $model->db->transBegin();
            $id = $model->insert([
                'date' => date('Y-m-d'),
                'total' => 0,
                'code' => $model->code(),
                'supplier_id' => $this->request->getPost('supplier')
                
            ]);
            
            $qtys = $this->request->getPost('qty');
            $prices = $this->request->getPost('price');
            $products = $this->request->getPost('product');
            $total = 0;
            
            if(!empty($products)){
                for($i = 0;$i<count($products);$i++){
                    $detail->insert([
                        'entrance_id'  => $id,
                        'product_id' => $products[$i],
                        'qty' => $qtys[$i],
                        'price' => $prices[$i]
                    ]);
                    $total += $prices[$i]*$qtys[$i];
                }
                
                $model->update($id,[
                   'total' => $total
                ]);
            }
            
            $model->db->transCommit();
            $output['url'] = site_url('barang-masuk');
            $output['error'] = false;
        } catch (Exception $ex) {
            $model->db->transRollback();
            $output['error'] = true;
            $output['message'] = 'Silahkan coba lagi';
        }
        return $this->response->setJSON($output);
    }
}
    
