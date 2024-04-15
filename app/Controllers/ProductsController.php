<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ProductsController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }


    public function index()
    {
        $model = new ProductModel();
        $products = $model->findAll();
        foreach ($products as &$product) {
            $product['providers'] = $model->getProviders($product['id']);
        }
        return $this->respond($products);
    }

    public function show($id = null)
    {
        $model = new ProductModel();
        $product = $model->find($id);
        if ($product) {
            $product['providers'] = $model->getProviders($id);
            return $this->respond($product);
        } else {
            return $this->failNotFound('Product not found');
        }
    }

    public function create()
    {
        $expectedFields = ['name', 'expiration', 'price', 'stock', 'description'];
        $data = $this->request->getPost($expectedFields);
        $model = new ProductModel();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error parsing JSON string: ' . $e->getMessage());
        }
    
        $model = new ProductModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }

    public function delete($id = null)
    {
        $model = new ProductModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
