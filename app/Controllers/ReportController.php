<?php namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\JenisModel;
use App\Models\EntranceModel;
use App\Models\OutgoingModel;
use App\Models\EntranceDetailModel;
use App\Models\OutgoingDetailModel;
use App\Models\PemasokModel;
use App\Libraries\Pdf;
use Hermawan\DataTables\DataTable;

class ReportController extends Basecontroller{
    public function entrance(){
        $pemasok = $this->request->getGet('pemasok');
        
        $entranceModel = new EntranceModel();
        $supplierModel = new PemasokModel();
        $suppliers = $supplierModel->findAll();
        
//        if(!empty($suppliers)){
//            foreach ($suppliers as $row){
//                
//                if($pemasok == $row['id']){
//                    
//                    $optSuppliers .= '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
//                }else{
//                    $optSuppliers .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
//                }
//            }
//        }
        
        $no = 1;
        $entrances = [];
        
        if(!empty($pemasok)){
            $entrances = $entranceModel->where('supplier_id', $pemasok)->findAll();
            foreach ($entrances as $row){
//                $table .= '<tr>';
//                $table .= '<td>'.$no.'</td>';
//                $table .= '<td>'.$row['code'].'</td>';
//                $table .= '<td>'.date('d-m-Y', strtotime($row['date'])).'</td>';
//                $table .= '<td>'.$row['total'].'</td>';
//                $table .= '</tr>';
//                $no++;
            }
        }
        return $this->view('report.entrance', [
            'entrances'=> $entrances,
            'pemasok'=> $pemasok,
            'suppliers'=> $suppliers
        ]);
//        return view('layout/header').
//               view('report/entrance', [
//                  'table'=> $table,
//                  'units'=> [],
//                  'supplier'=> $optSuppliers
//               ]).
//              view('layout/footer');
    }
    
    public function outgoing(){
        $no = 1;
        $table = '';
        $model = new OutgoingModel();
        $model->orderBy('id', 'desc');
        $qty = $model->findAll();
        
//        foreach($qty as $val){
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['code'].'</td>';
//            $table .= '<td>'.date('d-m-Y', strtotime($val['date'])).'</td>';
//            $table .= '<td>'.$val['total'].'</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
       return $this->view('report.outgoing', [
           'qty'=> $qty,
           'unit'=> [],
           'types'=> []
       ]);
//        return view('layout/header').
//               view('report/outgoing', [
//                   'table'=> $table,
//                   'units'=> [],
//                   'types'=> []
//                ]).
//               view('layout/footer');
    }
    
    public function stock(){
        $model = new BarangModel();
        $entrance = new EntranceDetailModel();
        $outgoing = new OutgoingDetailModel();
        $products = $model->list()->findAll();
        
//        foreach($products as $val){
//            $entrance = new EntranceDetailModel();
//            $in = $entrance->selectSum('qty')->where('product_id',$val['id'])->get()->getRow();
//            
//            $outgoing = new OutgoingDetailModel();
//            $out = $outgoing->selectSum('qty')->where('product_id',$val['id'])->get()->getRow();
//            
//            $stock = intval($in->qty)-intval($out->qty);
//            
//            $table .= '<tr>';
//            $table .= '<td>'.$no.'</td>';
//            $table .= '<td>'.$val['name'].'</td>';
//            $table .= '<td>'.$val['unit'].'</td>';
//            $table .= '<td>'.$val['type'].'</td>';
//            $table .= '<td>'.$stock.'</td>';
//            $table .= '</tr>';
//            $no++;
//        }
        
//        $unitModel = new SatuanModel();
//        $typesModel = new JenisModel(); 
        return $this->view('report.stock', [
            'products'=> $products,
            'entrance'=> $entrance,
            'outgoing'=> $outgoing
        ]);
//        return view('layout/header').
//               view('report/stock', [
//                   'table'=>$table,
//                   'units'=> $unitModel->findAll(),
//                   'types'=> $typesModel->findAll()
//                ]).
//               view('layout/footer');
    }
}