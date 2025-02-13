<?php

namespace App\Controllers;

class SigninController extends BaseController
{
    public function index(): string
    {
        return view('authentication/flows/basic/signIn');
    }
}
