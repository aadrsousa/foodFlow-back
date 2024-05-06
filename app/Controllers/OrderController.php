<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

/**
 * Controlador per gestionar les comandes.
 */
class OrderController extends Controller
{
    use ResponseTrait;

    /**
     * Obté totes les comandes.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        $model = new OrderModel();
        $comandes = $model->findAll();
        return $this->respond($comandes);
    }

    /**
     * Obté una comanda específica segons l'ID.
     *
     * @param int|null $id ID de la comanda
     * @return \CodeIgniter\HTTP\Response
     */
    public function show($id = null)
    {
        $model = new OrderModel();
        $comanda = $model->find($id);
        if ($comanda) {
            return $this->respond($comanda);
        } else {
            return $this->failNotFound('Comanda no trobada');
        }
    }

    /**
     * Crea una nova comanda.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create()
    {
        $expectedFields = ['provider', 'products', 'date', 'status'];
        $data = $this->request->getPost($expectedFields);
        $model = new OrderModel();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    /**
     * Actualitza una comanda existent segons l'ID.
     *
     * @param int|null $id ID de la comanda
     * @return \CodeIgniter\HTTP\Response
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error en analitzar la cadena JSON: ' . $e->getMessage());
        }

        $model = new OrderModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    /**
     * Elimina una comanda segons l'ID.
     *
     * @param int|null $id ID de la comanda
     * @return \CodeIgniter\HTTP\Response
     */
    public function delete($id = null)
    {
        $model = new OrderModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}

