<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/users');
    }
}


