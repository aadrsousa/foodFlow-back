<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RecipeModel;

/**
 * Controlador per gestionar les receptes.
 */
class RecipeController extends ResourceController
{
    use ResponseTrait;

    /**
     * Obté totes les receptes.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        try {
            $model = new RecipeModel();
            $data = $model->findAll();
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar les receptes.");
        }
    }

    /**
     * Crea una nova recepta.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create()
    {
        try {
            $model = new RecipeModel();
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'ingredients' => $this->request->getPost('ingredients'),
                'allergens' => $this->request->getPost('allergens'),
                'parent_recipe_id' => $this->request->getPost('parent_recipe_id'),
                'type_name' => $this->request->getPost('type_name')
            ];
            $model->insert($data);
            return $this->respondCreated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut crear la recepta");
        }
    }

    /**
     * Obté una recepta específica segons l'ID.
     *
     * @param int|null $id ID de la recepta
     * @return \CodeIgniter\HTTP\Response
     */
    public function show($id = null)
    {
        try {
            $model = new RecipeModel();
            $data = $model->find($id);
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound("No s'ha trobat la recepta amb ID: " . $id);
            }
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut recuperar la recepta");
        }
    }

    /**
     * Actualitza una recepta existent segons l'ID.
     *
     * @param int|null $id ID de la recepta
     * @return \CodeIgniter\HTTP\Response
     */
    public function update($id = null)
    {
        try {
            $model = new RecipeModel();
            $data = $this->request->getRawInput();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat la recepta amb ID: " . $id);
            }
            $model->update($id, $data);
            return $this->respondUpdated($data);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar la recepta");
        }
    }

    /**
     * Elimina una recepta segons l'ID.
     *
     * @param int|null $id ID de la recepta
     * @return \CodeIgniter\HTTP\Response
     */
    public function delete($id = null)
    {
        try {
            $model = new RecipeModel();
            if (!$model->find($id)) {
                return $this->failNotFound("No s'ha trobat la recepta amb ID: " . $id);
            }
            $model->delete($id);
            return $this->respondDeleted(['message' => "Recepta eliminada amb èxit."]);
        } catch (\Exception $e) {
            return $this->failServerError("No s'ha pogut actualitzar la recepta");
        }
    }
}

