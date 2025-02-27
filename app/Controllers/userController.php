<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $perPage = 10;

        $data = [
            'usuarios' => $userModel->paginate($perPage),
            'pager' => $userModel->pager,
        ];

        $data['usuarios'] = $userModel->findAll();

        return view('pages/lists/users', $data);
    }

    public function saveUser($id = null)
    {
        $userModel = new UserModel();
        helper(['form', 'url']);
        // Cargar datos del usuario si es edición
        $data['usuarios'] = $id ? $userModel->find($id) : null;

        if ($this->request->getMethod() == 'POST') {

            // Reglas de validación
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nombre' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'telefono' => 'required|numeric',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                // Mostrar errores de validación
                $data['validation'] = $validation;
            } else {
                // Preparar datos del formulario
                $userData = [
                    'nombre' => $this->request->getPost('nombre'),
                    'email' => $this->request->getPost('email'),
                ];

                if ($id) {
                    // Actualizar usuario existente
                    $userModel->update($id, $userData);
                    $message = 'Usuario actualizado correctamente.';
                } else {
                    // Crear nuevo usuario
                    $userModel->save($userData);
                    $message = 'Usuario creado correctamente.';
                }

                // Redirigir al listado con un mensaje de éxito
                return redirect()->to('pages/lists/users')->with('success', $message);
            }
        }

        // Cargar la vista del formulario (crear/editar)
        return view('pages/lists/user_form', $data);
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id); // Eliminar usuario
        return redirect()->to('/users')->with('success', 'Usuario eliminado correctamente.');
    }
}


