<?php

namespace App\Controllers;

use App\Models\ComandaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ComandaController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new ComandaModel();
        $comandes = $model->findAll();
        return $this->respond($comandes);
    }

    public function show($id = null)
    {
        $model = new ComandaModel();
        $comanda = $model->find($id);
        if ($comanda) {
            return $this->respond($comanda);
        } else {
            return $this->failNotFound('Comanda not found');
        }
    }

    public function create()
    {
        $expectedFields = ['proveidor', 'productes', 'data', 'estat'];
        $data = $this->request->getPost($expectedFields);
        $model = new ComandaModel();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analizar la cadena JSON: ' . $e->getMessage());
        }

        $model = new ComandaModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $model = new ComandaModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
