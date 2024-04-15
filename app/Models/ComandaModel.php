<?php

namespace App\Models;

use CodeIgniter\Model;

class ComandaModel extends Model
{
    protected $table = 'comanda';
    protected $primaryKey = 'id';
    protected $allowedFields = ['proveidor', 'productes', 'data', 'estat'];
}
