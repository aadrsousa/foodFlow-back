<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'ingredients', 'parent_recipe_id', 'allergens', 'type_name'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
