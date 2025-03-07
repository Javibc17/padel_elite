<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index(): string
    {
        $filterName = $this->request->getGet('filterName');
        $filterEmail = $this->request->getGet('filterEmail');
        $filterPhone = $this->request->getGet('filterPhone');
        $filterRole = $this->request->getGet('filterRole');
        $perPage = $this->request->getGet('perPage') ? filter_var($this->request->getGet('perPage'), FILTER_VALIDATE_INT) : 5; // Número de usuarios por página, valor por defecto 5

        $usuarios = $this->userModel;

        if ($filterName) {
            $usuarios->orLike('nombre', $filterName);
        }
        if ($filterEmail) {
            $usuarios->orLike('email', $filterEmail);
        }
        if ($filterPhone) {
            $usuarios->orLike('telefono', $filterPhone);
        }
        if ($filterRole) {
            $usuarios->orLike('rol', $filterRole);
        }

        $data = [
            'usuarios' => $usuarios->paginate($perPage),
            'pager' => $usuarios->pager,
            'filterName' => $filterName,
            'filterEmail' => $filterEmail,
            'filterPhone' => $filterPhone,
            'filterRole' => $filterRole,
            'perPage' => $perPage,
        ];

        return view('pages/lists/users', $data);
    }

    public function create()
    {
        return view('pages/create');
    }

    public function store()
    {
        $contraseña = $this->request->getPost('contraseña');
        $confirmarContraseña = $this->request->getPost('confirmar_contraseña');

        if ($contraseña !== $confirmarContraseña) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        $userModel = new UserModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => $this->request->getPost('rol'), // Añadido 'rol'
        ];

        $userModel->save($data);

        return redirect()->to('/users')->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (empty($data['user'])) {
            throw new PageNotFoundException('Usuario no encontrado');
        }

        // Obtener los filtros actuales
        $data['filterName'] = $this->request->getGet('filterName');
        $data['filterEmail'] = $this->request->getGet('filterEmail');
        $data['filterPhone'] = $this->request->getGet('filterPhone');
        $data['filterRole'] = $this->request->getGet('filterRole');

        return view('pages/edit', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => $this->request->getPost('rol'), // Añadido 'rol'
        ];

        $filterName = $this->request->getGet('filterName');
        $filterEmail = $this->request->getGet('filterEmail');
        $filterPhone = $this->request->getGet('filterPhone');
        $filterRole = $this->request->getGet('filterRole');

        $queryParams = http_build_query([
            'filterName' => $filterName,
            'filterEmail' => $filterEmail,
            'filterPhone' => $filterPhone,
            'filterRole' => $filterRole,
        ]);

        if ($userModel->update($id, $data)) {
            return redirect()->to('/users?' . $queryParams)->with('success', 'Usuario actualizado exitosamente');
        } else {
            return redirect()->to('/users?' . $queryParams)->with('error', 'No se pudo actualizar al usuario');
        }
    }

    public function deactivate($id)
    {
        $this->userModel->update($id, ['disabled' => 1]);
        return redirect()->to('/users')->with('success', 'Usuario dado de baja exitosamente');
    }

    public function activate($id)
    {
        $this->userModel->update($id, ['disabled' => 0]);
        return redirect()->to('/users')->with('success', 'Usuario reactivado exitosamente');
    }

    public function exportToCSV()
    {
        $usuarios = $this->userModel->findAll(); // Obtén los datos de los usuarios

        // Define el nombre del archivo y la cabecera
        $filename = 'usuarios.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Abre el archivo en modo escritura
        $output = fopen('php://output', 'w');

        // Agrega los encabezados
        fputcsv($output, ['Nombre', 'Email', 'Teléfono']);

        // Agrega los datos
        foreach ($usuarios as $usuario) {
            fputcsv($output, [$usuario['nombre'], $usuario['email'], $usuario['telefono']]);
        }

        // Cierra el archivo
        fclose($output);
        exit;
    }

    public function export()
    {
        $perPage = $this->request->getGet('perPage');
        $filterName = $this->request->getGet('filterName');
        $filterEmail = $this->request->getGet('filterEmail');
        $filterPhone = $this->request->getGet('filterPhone');
        $filterRole = $this->request->getGet('filterRole');
        $currentPage = $this->request->getGet('page') ? $this->request->getGet('page') : 1; // Default to page 1 if not set

        // Apply filters and pagination
        $query = $this->userModel->select('*');

        if ($filterName) {
            $query->like('nombre', $filterName);
        }
        if ($filterEmail) {
            $query->like('email', $filterEmail);
        }
        if ($filterPhone) {
            $query->like('telefono', $filterPhone);
        }
        if ($filterRole) {
            $query->like('rol', $filterRole);
        }

        // Get the current page of users
        $usuarios = $query->paginate($perPage, 'default', $currentPage);

        // Generate CSV
        $filename = 'usuarios_export_' . date('Ymd') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nombre', 'Email', 'Teléfono', 'Rol']);

        foreach ($usuarios as $usuario) {
            fputcsv($output, [$usuario['nombre'], $usuario['email'], $usuario['telefono'], $usuario['rol']]);
        }

        fclose($output);
        exit;
    }
}


