<?php

namespace App\Models;

use CodeIgniter\Model;

class AllergenModel extends Model
{
    protected $table = 'allergens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'icon_route'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
