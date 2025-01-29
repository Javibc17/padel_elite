<?php

namespace App\Controllers;

class RoleController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/roles');
    }
}
