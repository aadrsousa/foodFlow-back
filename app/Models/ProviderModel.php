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

    public function getProducts($provider_id)
    {
        $builder = $this->db->table('products_provider');
        $builder->select('product_id');
        $builder->where('provider_id', $provider_id);
        $results = $builder->get()->getResultArray();

        $products = [];
        foreach ($results as $result) {
            $product = $this->db->table('products')->select('id, name')->where('id', $result['product_id'])->get()->getRow();
            if ($product) {
                $products[] = $product;
            }
        }
        return $products;
    }
}
