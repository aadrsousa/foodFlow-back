<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model per gestionar els productes/stocks.
 */

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'expiration', 'stock', 'description'];

    public function getProviders($product_id)
    {
        $builder = $this->db->table('products_provider');
        $builder->select('provider_id');
        $builder->where('products_id', $product_id);
        $results = $builder->get()->getResultArray();

        $providers = [];
        foreach ($results as $result) {
            $provider = $this->db->table('providers')->select('id, company_identifier')->where('id', $result['provider_id'])->get()->getRow();
            if ($provider) {
                $providers[] = $provider;
            }
        }

        return $providers;
    }
}

