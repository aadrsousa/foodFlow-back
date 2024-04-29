<?php

namespace App\Controllers;

use App\Models\ProductsProviderModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ProductsProviderController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProviders = $productsProviderModel->findAll();
        return $this->respond($productsProviders);
    }

    public function show($id = null)
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProvider = $productsProviderModel->find($id);
        if ($productsProvider) {
            return $this->respond($productsProvider);
        } else {
            return $this->failNotFound('ProductsProvider not found');
        }
    }

    public function create()
    {
        $productsProviderModel = new ProductsProviderModel();
        $data = $this->request->getPost(['products_id', 'provider_id']);
        $productsProviderModel->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analitzar la cadena JSON: ' . $e->getMessage());
        }
        $productsProviderModel = new ProductsProviderModel();
        $productsProviderModel->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $productsProviderModel = new ProductsProviderModel();
        $productsProviderModel->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}


