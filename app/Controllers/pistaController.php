<?php

namespace App\Controllers;

class PistaController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/pistas');
    }
}
