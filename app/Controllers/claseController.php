<?php

namespace App\Controllers;

class ClaseController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/clases');
    }
}
