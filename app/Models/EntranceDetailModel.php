<?php
namespace App\Models;
use CodeIgniter\Model;

class EntranceDetailModel extends Model{
    protected $table = 'entrances_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['entrance_id', 'product_id', 'qty', 'price'];
    
    public function list($entrance_id) {
        $this->select('entrances_detail.qty, entrances_detail.price');
        $this->select('a.name as product, b.name as unit');
        $this->join('products a', 'entrances_detail.product_id = a.id');
        $this->join('units b', 'a.unit_id = b.id');
        $this->where('entrances_detail.entrance_id', $entrance_id);
        return $this;
    }
}
