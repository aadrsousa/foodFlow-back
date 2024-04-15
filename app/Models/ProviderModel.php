<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderModel extends Model
{
    protected $table = 'providers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'company_identifier', 'address', 'phone'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
