<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model per gestionar les comandes.
 */

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $allowedFields = ['provider', 'products', 'date', 'status'];
}
