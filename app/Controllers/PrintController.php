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


class PrintController extends BaseController{
    public function entrance(){
        $pdf = new Pdf();
        $pemasok = $this->request->getGet('supplier');
        $entranceModel = new EntranceModel();
        $no = 1;
        $table = '';
        
        if(!empty($pemasok)){
            $entrances = $entranceModel->where('supplier_id', $pemasok)->findAll();
            foreach ($entrances as $row){
                $table .= '<tr>';
                $table .= '<td>'.$no.'</td>';
                $table .= '<td>'.$row['code'].'</td>';
                $table .= '<td>'.date('d-m-Y', strtotime($row['date'])).'</td>';
                $table .= '<td>'.$row['total'].'</td>';
                $table .= '</tr>';
                $no++;
            }
        }
        
        return $pdf->generate(view('print/entrance',['table'=>$table]), 'laporan-barang-masuk', 'potrait');
    }
    
    public function outgoing(){
        $no = 1;
        $table = '';
        $pdf = new Pdf();
        $model = new OutgoingModel();
        $model->orderBy('id', 'desc');
        $qty = $model->findAll();
        
        foreach($qty as $val){
            $table .= '<tr>';
            $table .= '<td>'.$no.'</td>';
            $table .= '<td>'.$val['code'].'</td>';
            $table .= '<td>'.date('d-m-Y', strtotime($val['date'])).'</td>';
            $table .= '<td>'.$val['total'].'</td>';
            $table .= '</tr>';
            $no++;
        }
        
        return $pdf->generate(view('print/outgoing',['table'=>$table]), 'laporan-barang-keluar', 'potrait');
    }
    
    public function stock(){
        $no = 1;
        $table = '';
        $pdf = new Pdf();
        $model = new BarangModel();
        $products = $model->list()->findAll();
        
        foreach($products as $val){
            $entrance = new EntranceDetailModel();
            $in = $entrance->selectSum('qty')->where('product_id',$val['id'])->get()->getRow();
            
            $outgoing = new OutgoingDetailModel();
            $out = $outgoing->selectSum('qty')->where('product_id',$val['id'])->get()->getRow();
            
            $stock = intval($in->qty)-intval($out->qty);
            
            $table .= '<tr>';
            $table .= '<td>'.$no.'</td>';
            $table .= '<td>'.$val['name'].'</td>';
            $table .= '<td>'.$val['unit'].'</td>';
            $table .= '<td>'.$val['unit'].'</td>';
            $table .= '<td>'.$stock.'</td>';
            $table .= '</tr>';
            $no++;
        }
        
        $unitModel = new SatuanModel();
        $typesModel = new JenisModel();
        
        return $pdf->generate(view('print/stock',[
                   'table'=>$table,
                   'units'=> $unitModel->findAll(),
                   'types'=> $typesModel->findAll()]), 'laporan-stock', 'potrait');
    }
}