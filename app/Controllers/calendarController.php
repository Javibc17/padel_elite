<?php

namespace App\Controllers;

class CalendarController extends BaseController
{
    public function index(): string
    {
        return view('pages/lists/calendar');
    }
}
