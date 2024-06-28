<?php
namespace App\Models;
use CodeIgniter\Model;

class PenggunaModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'status'];
}

