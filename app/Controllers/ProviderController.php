<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProviderModel;

/**
 * Controlador per gestionar els proveïdors.
 */
class ProviderController extends ResourceController
{
    use ResponseTrait;

    /**
     * Obté tots els proveïdors amb els seus productes associats.
     *
     * @return \CodeIgniter\HTTP\Response
     */
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

    /**
     * Crea un nou proveïdor.
     *
     * @return \CodeIgniter\HTTP\Response
     */
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

    /**
     * Obté un proveïdor específic segons l'ID amb els seus productes associats.
     *
     * @param int|null $id ID del proveïdor
     * @return \CodeIgniter\HTTP\Response
     */
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

    /**
     * Actualitza un proveïdor existent segons l'ID.
     *
     * @param int|null $id ID del proveïdor
     * @return \CodeIgniter\HTTP\Response
     */
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

    /**
     * Elimina un proveïdor segons l'ID.
     *
     * @param int|null $id ID del proveïdor
     * @return \CodeIgniter\HTTP\Response
     */
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

