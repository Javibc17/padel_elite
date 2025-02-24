<?php

namespace App\Controllers;

use App\Models\ClaseusuarioModel;

class ClasesUsuarioController extends BaseController
{
    public function index(): string
    {
        $clasesusuarioModel = new ClaseusuarioModel();

        $perPage = 10;

        $data = [
            'clasesUsuario' => $clasesusuarioModel->paginate($perPage),
            'pager' => $clasesusuarioModel->pager,
        ];

        return view('pages/lists/clasesUsuario', $data);
    }
}


