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
     * Registra un nou usuari.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function register(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
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
        } catch (\Exception $e) {
            return $this->failServerError('Error al servidor');
        }
    }

    /**
     * Inicia sessió d'un usuari.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function login(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $model = new UserModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user = $model->where('email', $email)->first();

            if (!$user) {
                return $this->failNotFound("No s'ha trobat l'usuari");
            }

            if (!password_verify($password, $user['password'])) {
                return $this->fail('Contrasenya incorrecta');
            }

            $key = getenv('JWT_SECRET');
            $payload = [
                'iat' => time(),
                'exp' => time() + 3600,
                'sub' => $user['id'],
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            return $this->respond(['token' => $jwt]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al servidor');
        }
    }
}

