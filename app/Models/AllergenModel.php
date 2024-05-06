<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model per gestionar els allergens.
 */

class AllergenModel extends Model
{
    protected $table = 'allergens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'icon_route'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
