<?php
namespace App\Models;
use CodeIgniter\Model;

class BarangModel extends Model{
    protected $table ='products';
    protected $primaryKey = 'id';
    protected  $allowedFields = ['name', 'unit_id', 'type_id'];
    
    public function list(){
        $this->select('products.id,products.name,products.unit_id,products.type_id, a.name as type, b.name as unit');
        $this->join('types a', 'a.id = products.type_id');
        $this->join('units b', 'b.id = products.unit_id');
        return $this;
    }
}

