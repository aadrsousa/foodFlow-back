<?php

namespace App\Controllers;

use App\Models\CentreModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class CentresController extends Controller
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
        $model = new CentreModel();
        $centres = $model->findAll();
        return $this->respond($centres);
    }

    public function show($id = null)
    {
        $model = new CentreModel();
        $centre = $model->find($id);
        if ($centre) {
            return $this->respond($centre);
        } else {
            return $this->failNotFound('Centre not found');
        }
    }

    public function create()
    {
        $expectedFields = ['nom', 'alias', 'adreca', 'comencals', 'nom_encarregat', 'telefon', 'correu_electronic','imatge'];
    
        $data = $this->request->getPost($expectedFields);
    
        $model = new CentreModel();
    
        $model->insert($data);
    
        return $this->respondCreated($data);
    }
    

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analizar la cadena JSON: ' . $e->getMessage());
        }
    
        $model = new CentreModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }
    

    public function delete($id = null)
    {
        $model = new CentreModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
