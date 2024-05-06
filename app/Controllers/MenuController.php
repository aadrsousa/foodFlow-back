<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

/**
 * Controlador per gestionar els menús.
 */
class MenuController extends ResourceController
{
    use ResponseTrait;

    /**
     * Obté tots els menús.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        try {
            $model = new MenuModel();
            $data = $model->findAll();
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar els menús");
        }
    }

    /**
     * Crea un nou menú.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create()
    {
        try {
            $model = new MenuModel();
            $data = [
                'date' => $this->request->getPost('date'),
                'first_course' => $this->request->getPost('first_course'),
                'second_course' => $this->request->getPost('second_course'),
                'dessert' => $this->request->getPost('dessert')
            ];
            $model->insert($data);
            return $this->respondCreated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear el menú");
        }
    }

    /**
     * Obté un menú específic segons el seu ID.
     *
     * @param int|null $id ID del menú
     * @return \CodeIgniter\HTTP\Response
     */
    public function show($id = null)
    {
        try {
            $model = new MenuModel();
            $data = $model->find($id);
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound("No s'ha trobat cap menú amb ID: " . $id);
            }
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar el menú");
        }
    }

    /**
     * Actualitza un menú existent segons el seu ID.
     *
     * @param int|null $id ID del menú
     * @return \CodeIgniter\HTTP\Response
     */
    public function update($id = null)
    {
        try {
            $model = new MenuModel();
            $data = $this->request->getRawInput();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat cap menú amb ID: " . $id);
            }
            $model->update($id, $data);
            return $this->respondUpdated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar el menú");
        }
    }

    /**
     * Elimina un menú segons el seu ID.
     *
     * @param int|null $id ID del menú
     * @return \CodeIgniter\HTTP\Response
     */
    public function delete($id = null)
    {
        try {
            $model = new MenuModel();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat cap menú amb ID: " . $id);
            }
            $model->delete($id);
            return $this->respondDeleted(['message' => "Menú eliminat amb èxit"]);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha eliminar crear el menú");
        }
    }
}

