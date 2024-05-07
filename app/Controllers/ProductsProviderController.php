<?php

namespace App\Controllers;

use App\Models\ProductsProviderModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

/**
 * Controlador per gestionar els vincles entre productes i proveïdors.
 */
class ProductsProviderController extends Controller
{
    use ResponseTrait;

    /**
     * Obté tots els vincles entre productes i proveïdors.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProviders = $productsProviderModel->findAll();
        return $this->respond($productsProviders);
    }

    /**
     * Obté un vincle entre producte i proveïdor específic segons l'ID.
     *
     * @param int|null $id ID del vincle
     * @return \CodeIgniter\HTTP\Response
     */
    public function show($id = null)
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProvider = $productsProviderModel->find($id);
        if ($productsProvider) {
            return $this->respond($productsProvider);
        } else {
            return $this->failNotFound('Vincle entre producte i proveïdor no trobat');
        }
    }

    /**
     * Crea un nou vincle entre producte i proveïdor.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create()
    {
        $productsProviderModel = new ProductsProviderModel();
        $data = $this->request->getPost(['products_id', 'provider_id']);
        $productsProviderModel->insert($data);
        return $this->respondCreated($data);
    }

    /**
     * Actualitza un vincle entre producte i proveïdor existent segons l'ID.
     *
     * @param int|null $id ID del vincle
     * @return \CodeIgniter\HTTP\Response
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error en analitzar la cadena JSON: ' . $e->getMessage());
        }
        $productsProviderModel = new ProductsProviderModel();
        $productsProviderModel->update($id, $data);
        return $this->respondUpdated($data);
    }

    /**
     * Elimina un vincle entre producte i proveïdor segons l'ID.
     *
     * @param int|null $id ID del vincle
     * @return \CodeIgniter\HTTP\Response
     */
    public function delete($id = null)
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProviderModel->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}



