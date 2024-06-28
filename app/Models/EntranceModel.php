<?php
namespace App\Models;
use CodeIgniter\Model;

class EntranceModel extends Model{
    protected $table = 'entrances';
    protected $primaryKey = 'id';
    protected $allowedFields = ['supplier_id', 'code', 'total', 'date'];
    
    public function code(){
        $this->select('RIGHT(code,4) as no', false);
        $this->where('YEAR(date)', date('Y'));
        $this->where('MONTH(date)', date('m'));
        $this->orderBy('id', 'desc');
        $value = $this->first();
        
        if (!empty($value)){
            $code = intval($value['no'])+1;
        }else{
            $code = 1;
        }
        return date('ym').str_pad($code, 4, '0', STR_PAD_LEFT);
    }
    
    public function list(){
        $this->select('entrances.id, entrances.code, entrances.date, entrances.total');
        $this->select('a.name as supplier');
        $this->join('suppliers a', 'entrances.supplier_id = a.id');
        $this->orderBy('entrances.id', 'desc');
        return $this;
    }
}