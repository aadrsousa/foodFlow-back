<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Model per gestionar els productes i proveidors.
 */

class ProductsProviderModel extends Model
{
    protected $table = 'products_provider';
    protected $primaryKey = 'id';
    protected $allowedFields = ['products_id', 'provider_id'];
}