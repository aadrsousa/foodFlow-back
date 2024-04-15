<?php

namespace App\Controllers;

use App\Models\ProducteModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ProductesController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    public function index()
    {
        $model = new ProducteModel();
        $productes = $model->findAll();
        foreach ($productes as &$producte) {
            $producte['proveidors'] = $model->getProveidors($producte['id']);
        }
        return $this->respond($productes);
    }

    public function show($id = null)
    {
        $model = new ProducteModel();
        $producte = $model->find($id);
        if ($producte) {
            $producte['proveidors'] = $model->getProveidors($id);
            return $this->respond($producte);
        } else {
            return $this->failNotFound('Producte not found');
        }
    }

    public function create()
    {
        $expectedFields = ['nom', 'caducitat', 'preu', 'stock', 'descripcio'];
        $data = $this->request->getPost($expectedFields);
        $model = new ProducteModel();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analitzar la cadena JSON: ' . $e->getMessage());
        }
    
        $model = new ProducteModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $model = new ProducteModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}