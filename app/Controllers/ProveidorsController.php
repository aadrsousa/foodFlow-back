<?php

namespace App\Controllers;

use App\Models\ProveidorModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ProveidorsController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        // Configura los headers CORS
        header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    public function index()
    {
        $model = new ProveidorModel();
        $proveidors = $model->findAll();
        foreach ($proveidors as &$proveidor) {
            $proveidor['productes'] = $model->getProductes($proveidor['id']);
        }
        return $this->respond($proveidors);
    }

    public function show($id = null)
    {
        $model = new ProveidorModel();
        $proveidor = $model->find($id);
        if ($proveidor) {
            $proveidor['productes'] = $model->getProductes($id);
            return $this->respond($proveidor);
        } else {
            return $this->failNotFound('Proveidor not found');
        }
    }

    public function create()
    {
        $expectedFields = ['nom', 'telefon', 'adreça', 'correu'];
        $data = $this->request->getPost($expectedFields);
        $model = new ProveidorModel();
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
    
        $model = new ProveidorModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $model = new ProveidorModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}