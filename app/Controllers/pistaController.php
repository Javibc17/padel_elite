<?php

namespace App\Controllers;

use App\Models\PistaModel;

class PistaController extends BaseController
{
    public function index(): string
    {
        $pistaModel = new PistaModel();

        $perPage = 10;

        $data = [
            'pistas' => $pistaModel->paginate($perPage),
            'pager' => $pistaModel->pager,
        ];

        return view('pages/lists/pistas', $data);
    }
}


