<?php

namespace App\Controllers;

use App\Models\RoleModel;

class RoleController extends BaseController
{
    public function index(): string
    {
        $roleModel = new RoleModel();

        $perPage = 10;

        $data = [
            'roles' => $roleModel->paginate($perPage),
            'pager' => $roleModel->pager,
        ];

        return view('pages/lists/roles', $data);
    }
}


