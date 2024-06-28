<?php
namespace App\Models;
use CodeIgniter\Model;

class JenisModel extends Model{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}
