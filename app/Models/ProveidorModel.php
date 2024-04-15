<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveidorModel extends Model
{
    protected $table = 'proveidor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'telefon', 'adreça', 'correu'];

    public function getProductes($proveidor_id)
    {
        $builder = $this->db->table('producte_proveidor');
        $builder->select('producte_id');
        $builder->where('proveidor_id', $proveidor_id);
        $results = $builder->get()->getResultArray();

        $productes = [];
        foreach ($results as $result) {
            $producte = $this->db->table('producte')->select('id, nom')->where('id', $result['producte_id'])->get()->getRow();
            if ($producte) {
                $productes[] = $producte;
            }
        }

        return $productes;
    }
}