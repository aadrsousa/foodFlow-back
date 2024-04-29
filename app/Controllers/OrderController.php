<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class OrderController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new OrderModel();
        $comandes = $model->findAll();
        return $this->respond($comandes);
    }

    public function show($id = null)
    {
        $model = new OrderModel();
        $comanda = $model->find($id);
        if ($comanda) {
            return $this->respond($comanda);
        } else {
            return $this->failNotFound('Order not found');
        }
    }

    public function create()
    {
        $expectedFields = ['provider', 'products', 'date', 'status'];
        $data = $this->request->getPost($expectedFields);
        $model = new OrderModel();
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

        $model = new OrderModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $model = new OrderModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
