<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table = 'centres';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'alias', 'adreca', 'comencals', 'nom_encarregat', 'telefon', 'correu_electronic','imatge'];
}
