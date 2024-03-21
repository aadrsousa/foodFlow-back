<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class UserController extends ResourceController
{
    use ResponseTrait;

    /**
     * @throws \ReflectionException
     */
    public function register(): \CodeIgniter\HTTP\ResponseInterface
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'firstname'=> $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'role'     => $this->request->getVar('role'),
        ];
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function login(): \CodeIgniter\HTTP\ResponseInterface
    {
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $model->where('email', $email)->first();

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        if (!password_verify($password, $user['password'])) {
            return $this->fail('Invalid password');
        }

        $key = getenv('JWT_SECRET');
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user['id'],
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $this->respond(['token' => $jwt]);
    }
}
