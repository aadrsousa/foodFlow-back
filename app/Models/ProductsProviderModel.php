<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsProviderModel extends Model
{
    protected $table = 'products_provider';
    protected $primaryKey = 'id';
    protected $allowedFields = ['products_id', 'provider_id'];
}