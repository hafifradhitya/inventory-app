<?php
namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\OutgoingModel;
use App\Models\OutgoingDetailModel;
use App\Models\EntranceDetailModel;
use Hermawan\DataTables\DataTable;

class OutgoingController extends BaseController{
    public function index(){
        return $this->view('outgoing.list');
//        $no = 1;
//        $table = '';
//        $model = new OutgoingModel();
//        $model->orderBy('id', 'desc');
//        $qty = $model->findAll();
//        
//        foreach($qty as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['code'].'</td>';
//            $table .= '<td>'.date('d-m-Y', strtotime($val['date'])).'</td>';
//            $table .= '<td style="text-align: right;">'. number_format($val['total'], 0, '.', '.').'</td>';
//            $table .= '<td style="width:100px; text-align: center;">';
//            $table .= '<a href="'.site_url('barang-keluar/detail/'.$val['id']).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
//            $table .= '<button data-id="'.$val['id'].'" data-url="'.site_url('barang-keluar/delete').'" data-redirect="'.site_url('barang-keluar').'" class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>';
//            $table .= '</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
//        return view('layout/header').
//               view('outgoing/list', ['table'=>$table]).
//               view('layout/footer');
    }
    
    public function list(){
        $model = new OutgoingModel();
        //$outgoings = $model->list()->findAll();
        return DataTable::of($model)
                ->addNumbering('no')
                ->add('action', function($val){
                    $btn = '<a href="'.site_url('barang-keluar/detail/'.$val->id).'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
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
        $model = new OutgoingDetailModel();
        $model->list($this->request->getPost('outgoing'));
        return DataTable::of($model)
                ->addNumbering('no')
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
        $model = new OutgoingModel();
        $barang = new BarangModel();
        $entrance = new EntranceDetailModel();
        $outgoing = new OutgoingDetailModel();
        
        
        $products = [];
        
        foreach ($barang->list()->findAll() as $row){
            $in = $entrance->selectSum('qty')->where('product_id',$row['id'])->get()->getRow();
            $out = $outgoing->selectSum('qty')->where('product_id',$row['id'])->get()->getRow();
            $stock = intval($in->qty)-intval($out->qty);
            
            $products[] = [
                'id' => $row['id'],
                'type' => $row['type'],
                'unit' => $row['unit'],
                'name' => $row['name'],
                'stok' => $stock
            ];
        }
        
        return $this->view('outgoing.add', [
            'code' => $model->code(),
            'barang' => $products
        ]);
    }
    
    public function delete(){
        $model = new OutgoingModel();
        $detail = new OutgoingDetailModel();
        $id = $this->request->getPost('id');
        $model->delete($id);
        $detail->where('outgoing_id', $id)->delete();
        return $this->response->setJSON([
           'error' => false
        ]);
    }
    
    public function detail($id) {
//        $no = 1;
//        $table = '';
//        $model = new OutgoingDetailModel();
//        $qty = $model->list($id)->findAll();
//        
//        foreach ($qty as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['product'].'</td>';
//            $table .= '<td style="text-align: right;">'. number_format($val['qty'], 0, '.', '.').'</td>';
//            $table .= '<td>'.$val['unit'].'</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
        return $this->view('outgoing.detail', [
           'outgoing' => $id
        ]);
    }
    
    public function submit(){
        $model = new OutgoingModel();
        $detail = new OutgoingDetailModel();
        
        try{
            $model->db->transBegin();
            $id = $model->insert([
               'date' => date('Y-m-d'),
               'total' => 0,
               'code' => $model->code(),
            ]);
            
            $qtys = $this->request->getPost('qty');
            $products = $this->request->getPost('product');
            $qty = 0;
            
            if(!empty($products)){
                for($i = 0;$i<count($products);$i++){
                    $detail->insert([
                       'outgoing_id' => $id,
                       'product_id' => $products[$i],
                       'qty' => $qtys[$i]
                    ]);
                    $qty += $qtys[$i];
                }
                
                $model->update($id,[
                   'total' => $qty
                ]);
            }
            
            $model->db->transCommit();
            $output['url'] = site_url('barang-keluar');
            $output['error'] = false;
        } catch (Exception $ex) {
            $model->db->transRollback();
            $output['error'] = true;
            $output['message'] = 'Silahkan Coba Lagi';
        }
        return $this->response->setJSON($output);
    }
}

