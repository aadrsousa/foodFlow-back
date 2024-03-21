<?php

namespace App\Controllers;

use App\Models\CentreModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

/**
 * Control·lador per gestionar centres.
 */

class CentresController extends Controller
{
    use ResponseTrait;

     // Configura els headers CORS per permetre les peticions des de l'origen especificat.

    public function __construct()
    {
        header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /**
     * Obté tots els centres.
     *
     * @return \CodeIgniter\HTTP\Response
     */

    public function index()
    {
        $model = new CentreModel();
        $centres = $model->findAll();
        return $this->respond($centres);
    }

     /**
     * Obté un centre específic segons l'ID.
     *
     * @param int|null $id ID del centre
     * @return \CodeIgniter\HTTP\Response
     */

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

     /**
     * Crea un nou centre.
     *
     * @return \CodeIgniter\HTTP\Response
     */

    public function create()
    {
        $expectedFields = ['nom', 'alias', 'adreca', 'comencals', 'nom_encarregat', 'telefon', 'correu_electronic','imatge'];
    
        $data = $this->request->getPost($expectedFields);
    
        $model = new CentreModel();
    
        $model->insert($data);
    
        return $this->respondCreated($data);
    }
    
     /**
     * Actualitza un centre existent segons l'ID.
     *
     * @param int|null $id ID del centre
     * @return \CodeIgniter\HTTP\Response
     */

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON();
        } catch (\Exception $e) {
            return $this->failValidationError('Error al analitzar la cadena JSON: ' . $e->getMessage());
        }
    
        $model = new CentreModel();
        $model->update($id, $data);
        return $this->respondUpdated($data);
    }
     /**
     * Elimina un centre segons l'ID.
     *
     * @param int|null $id ID del centre
     * @return \CodeIgniter\HTTP\Response
     */

    public function delete($id = null)
    {
        $model = new CentreModel();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
