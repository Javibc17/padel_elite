<?php

namespace App\Controllers;

use App\Models\UserModel; // Importamos el modelo de usuarios para interactuar con la base de datos.

class AuthController extends BaseController
{
    /**
     * @var UserModel
     */
    protected $UserModel;

    /**
     * Muestra el formulario de registro de usuario.
     */
    public function register()
    {
        return view('authentication/register'); // Carga y retorna la vista del formulario de registro.
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function processRegister()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombre' => 'required',
            'telefono' => 'required|numeric|exact_length[9]',
            'email' => 'required|valid_email',
            'contraseña' => 'required|min_length[8]',
            'confirm-password' => 'required|matches[contraseña]',
            'rol' => 'required',
            'toc' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $userModel = new UserModel();
        $existingUser = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'El correo electrónico ya está registrado.'
            ]);
        }

        try {
            $userModel->save([
                'nombre' => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('email'),
                'contraseña' => password_hash($this->request->getPost('contraseña'), PASSWORD_DEFAULT),
                'rol' => $this->request->getPost('rol'),
                'disabled' => 0 // Asigna el estado activo por defecto
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Hubo un problema al crear la cuenta. Por favor, inténtalo de nuevo.'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Cuenta creada exitosamente.'
        ]);
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function login()
    {
        return view('authentication/login'); // Asegúrate de que esta ruta sea correcta.
    }

    /**
     * Procesa el inicio de sesión del usuario.
     */
    public function processLogin()
    {
        helper(['form', 'url']);
        $session = session();

        $rules = [
            'email' => 'required|valid_email',
            'contraseña' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('contraseña'), $user['contraseña'])) {
            $session->set([
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'email' => $user['email'],
                'isLoggedIn' => true,
                'created_at' => $user['created_at'],
            ]);

            // Redirigir a Home::index después de un inicio de sesión exitoso
            return redirect()->to('/home')->with('success', 'Inicio de sesión exitoso.');
        }

        return redirect()->back()->withInput()->with('error', 'Correo o contraseña incorrectos.');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        $session = session(); // Inicia o accede a la sesión.
        $session->destroy(); // Destruye todos los datos de la sesión.

        // Redirige al formulario de inicio de sesión con un mensaje de éxito.
        return redirect()->to('login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
