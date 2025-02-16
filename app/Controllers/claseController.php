<?php

namespace App\Controllers;

use App\Models\ClaseModel;

class ClaseController extends BaseController
{
    public function index()
    {
        $claseModel = new ClaseModel();
        $data['clase'] = $claseModel->findAll();

        return view('pages/lists/clases', $data);
    }
}
