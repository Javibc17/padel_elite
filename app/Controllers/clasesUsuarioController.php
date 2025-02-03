<?php

namespace App\Controllers;

class ClasesUsuarioController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/clasesUsuario');
    }
}
