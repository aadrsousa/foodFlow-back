<?php

namespace App\Controllers;

use App\Models\ProducteProveidorModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ProducteProveidorController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $producteProveidorModel = new ProducteProveidorModel();
        $producteProveidors = $producteProveidorModel->findAll();
        return $this->respond($producteProveidors);
    }

    public function show($id = null)
    {
        $producteProveidorModel = new ProducteProveidorModel();
        $producteProveidor = $producteProveidorModel->find($id);
        if ($producteProveidor) {
            return $this->respond($producteProveidor);
        } else {
            return $this->failNotFound('ProducteProveidor not found');
        }
    }

    public function create()
    {
        $producteProveidorModel = new ProducteProveidorModel();
        $data = $this->request->getPost(['producte_id', 'proveidor_id']);
        $producteProveidorModel->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analitzar la cadena JSON: ' . $e->getMessage());
        }
        $producteProveidorModel = new ProducteProveidorModel();
        $producteProveidorModel->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $producteProveidorModel = new ProducteProveidorModel();
        $producteProveidorModel->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}

