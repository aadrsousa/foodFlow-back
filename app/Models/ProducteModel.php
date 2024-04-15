<?php

namespace App\Models;

use CodeIgniter\Model;

class ProducteModel extends Model
{
    protected $table = 'producte';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'caducitat', 'preu', 'stock', 'descripcio'];

    public function getProveidors($producte_id)
    {
        $builder = $this->db->table('producte_proveidor');
        $builder->select('proveidor_id');
        $builder->where('producte_id', $producte_id);
        $results = $builder->get()->getResultArray();

        $proveidors = [];
        foreach ($results as $result) {
            $proveidor = $this->db->table('proveidor')->select('id, nom')->where('id', $result['proveidor_id'])->get()->getRow();
            if ($proveidor) {
                $proveidors[] = $proveidor;
            }
        }

        return $proveidors;
    }
}
