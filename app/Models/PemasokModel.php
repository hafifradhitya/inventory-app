<?php
namespace App\Models;
use CodeIgniter\Model;

class PemasokModel extends Model{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'phone', 'address', 'sales'];
}