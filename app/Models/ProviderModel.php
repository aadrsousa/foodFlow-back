<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderModel extends Model
{
    protected $table = 'proveidor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'telefon', 'adreça', 'correu'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
