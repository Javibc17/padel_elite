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

        return view('pages/lists/users', $data);
    }
}


