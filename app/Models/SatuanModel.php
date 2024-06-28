<?php
namespace App\Models;
use CodeIgniter\Model;

class SatuanModel extends Model{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}