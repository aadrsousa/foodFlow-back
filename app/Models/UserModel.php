<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Model per gestionar els usuaris.
 */

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['username', 'email', 'password', 'firstname', 'lastname', 'role'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->passwordHash($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->passwordHash($data);
    }

    protected function passwordHash(array $data): array
    {
        if (isset($data['data']['password']))
        {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
