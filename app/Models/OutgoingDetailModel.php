<?php
namespace App\Models;
use CodeIgniter\Model;

class OutgoingDetailModel extends Model{
    protected $table = 'outgoings_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['outgoing_id', 'product_id', 'qty'];
    
    public function list($outgoing_id) {
        $this->select('outgoings_detail.id, outgoings_detail.qty, outgoings_detail.outgoing_id, outgoings_detail.product_id');
        $this->select('a.name as product, b.name as unit');
        $this->join('products a', 'outgoings_detail.product_id = a.id');
        $this->join('units b', 'a.unit_id = b.id');
        $this->where('outgoings_detail.outgoing_id', $outgoing_id);
        return $this;
    }
}
