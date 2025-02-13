<?php

namespace App\Controllers;

use App\Models\UserModel;

class SignUpController extends BaseController
{

    public function index(): string
    {
        return view('authentication/flows/basic/signUp');
    }
    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'email' => $this->request->getPost('email'),
            'contraseña' => password_hash($this->request->getPost('contraseña'), PASSWORD_DEFAULT),
        ];

        if ($userModel->insert($data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}