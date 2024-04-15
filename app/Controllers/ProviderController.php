<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProviderModel;

class ProviderController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        try {
            $model = new ProviderModel();
            $providers = $model->findAll();
            foreach ($providers as &$provider) {
                $provider['products'] = $model->getProducts($provider['id']);
            }
            return $this->respond($providers);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar els proveïdors.");
        }
    }

    public function create()
    {
        try {
            $model = new ProviderModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'company_identifier' => $this->request->getPost('company_identifier'),
                'address' => $this->request->getPost('address'),
                'phone' => $this->request->getPost('phone')
            ];
            $model->insert($data);
            return $this->respondCreated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear el proveïdor");
        }
    }

    public function show($id = null)
    {
        try {
            $model = new ProviderModel();
            $provider = $model->find($id);
            if ($provider) {
                $provider['products'] = $model->getProducts($id);
                return $this->respond($provider);
            } else {
                return $this->failNotFound("No s'ha trobat el proveïdor amb ID: " . $id);
            }
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar el proveïdor");
        }
    }

    public function update($id = null)
    {
        try {
            $model = new ProviderModel();
            $data = $this->request->getRawInput();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat el proveïdor amb ID: " . $id);
            }
            $model->update($id, $data);
            return $this->respondUpdated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar el proveïdor");
        }
    }

    public function delete($id = null)
    {
        try {
            $model = new ProviderModel();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat el proveïdor amb ID :" . $id);
            }
            $model->delete($id);
            return $this->respondDeleted(['message' => "Proveïdor eliminat amb èxit"]);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut eliminar el proveïdor.");
        }
    }
}
