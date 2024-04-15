<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PriceModel;

class PriceController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        try {
            $model = new PriceModel();
            $data = $model->findAll();
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar els preus.");
        }
    }

    public function create()
    {
        try {
            $model = new PriceModel();
            $data = [
                'product_id' => $this->request->getPost('product_id'),
                'provider_id' => $this->request->getPost('provider_id'),
                'price' => $this->request->getPost('price')
            ];
            $model->insert($data);
            return $this->respondCreated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear el preu");
        }
    }

    public function show($id = null)
    {
        try {
            $model = new PriceModel();
            $data = $model->find($id);
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound("No s'ha trobat el preu amb ID: " . $id);
            }
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar el preu");
        }
    }

    public function update($id = null)
    {
        try {
            $model = new PriceModel();
            $data = $this->request->getRawInput();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat el preu amb ID: " . $id);
            }
            $model->update($id, $data);
            return $this->respondUpdated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar el preu");
        }
    }

    public function delete($id = null)
    {
        try {
            $model = new PriceModel();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat el preu amb ID: " . $id);
            }
            $model->delete($id);
            return $this->respondDeleted(['message' => "Preu eliminat amb èxit"]);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut eliminar el preu");
        }
    }
}
