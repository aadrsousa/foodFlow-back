<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model per gestionar els preus.
 */

class PriceModel extends Model
{
    protected $table = 'prices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'provider_id', 'price'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
