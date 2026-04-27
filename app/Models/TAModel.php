<?php
namespace App\Models;
use CodeIgniter\Model;

class TAModel extends Model {
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_ajaran', 'status'];
}