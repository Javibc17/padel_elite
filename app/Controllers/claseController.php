<?php

namespace App\Controllers;

use App\Models\ClaseModel;

class ClaseController extends BaseController
{
    public function index(): string
    {
        $claseModel = new ClaseModel();

        $perPage = 10;

        $data = [
            'clases' => $claseModel->paginate($perPage),
            'pager' => $claseModel->pager,
        ];

        return view('pages/lists/clases', $data);
    }
}
