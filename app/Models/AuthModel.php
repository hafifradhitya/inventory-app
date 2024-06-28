<?php
namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'status'];
}