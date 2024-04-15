<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AllergenModel;

class AllergenController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        try {
            $model = new AllergenModel();
            $data = $model->findAll();
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar els al·lèrgens.");
        }
    }

    public function create()
    {
        try {
            $model = new AllergenModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'icon_route' => $this->request->getPost('icon_route')
            ];
            $model->insert($data);
            return $this->respondCreated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear l'al·lergen.");
        }
    }

    public function show($id = null)
    {
        try {
            $model = new AllergenModel();
            $data = $model->find($id);
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound("No s'ha pogut trobar l'al·lergen amb ID: " . $id);
            }
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar l'al·lergen.");
        }
    }

    public function update($id = null)
    {
        try {
            $model = new AllergenModel();
            $data = $this->request->getRawInput();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha pogut trobar l'al·lergen amb ID: " . $id);
            }
            $model->update($id, $data);
            return $this->respondUpdated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar l'al·lergen.");
        }
    }

    public function delete($id = null)
    {
        try {
            $model = new AllergenModel();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha pogut trobar l'al·lergen amb ID: " . $id);
            }
            $model->delete($id);
            return $this->respondDeleted(['message' => "Al·lèrgen eliminat amb èxit"]);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear l'al·lergen.");
        }
    }
}
