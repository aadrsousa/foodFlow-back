<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

/**
 * Controlador per gestionar els productes.
 */
class ProductsController extends Controller
{
    use ResponseTrait;

    /**
     * Obté tots els productes amb els seus proveïdors.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        $model = new ProductModel();
        $products = $model->findAll();
        foreach ($products as &$product) {
            $product['providers'] = $model->getProviders($product['id']);
        }
        return $this->respond($products);
    }

    /**
     * Obté un producte específic amb els seus proveïdors segons l'ID.
     *
     * @param int|null $id ID del producte
     * @return \CodeIgniter\HTTP\Response
     */
    public function show($id = null)
    {
        $model = new ProductModel();
        $product = $model->find($id);
        if ($product) {
            $product['providers'] = $model->getProviders($id);
            return $this->respond($product);
        } else {
            return $this->failNotFound('Producte no trobat');
        }
    }

    /**
     * Crea un nou producte.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create()
    {
        $expectedFields = ['name', 'expiration', 'price', 'stock', 'description'];
        $data = $this->request->getPost($expectedFields);
        $model = new ProductModel();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    /**
     * Actualitza un producte existent segons l'ID.
     *
     * @param int|null $id ID del producte
     * @return \CodeIgniter\HTTP\Response
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error en analitzar la cadena JSON: ' . $e->getMessage());
        }
    
        $model = new ProductModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    /**
     * Elimina un producte segons l'ID.
     *
     * @param int|null $id ID del producte
     * @return \CodeIgniter\HTTP\Response
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}

