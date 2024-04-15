<?php

namespace App\Models;

use CodeIgniter\Model;

class ProducteProveidorModel extends Model
{
    protected $table = 'producte_proveidor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['producte_id', 'proveidor_id'];
}