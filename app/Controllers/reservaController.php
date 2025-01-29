<?php

namespace App\Controllers;

class ReservaController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/reservas');
    }
}
