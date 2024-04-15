<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'first_course', 'second_course', 'dessert'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
