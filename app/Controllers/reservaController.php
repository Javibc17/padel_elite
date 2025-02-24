<?php

namespace App\Controllers;

use App\Models\ReservaModel;


class ReservaController extends BaseController
{
    public function index(): string
    {
        $reservaModel = new ReservaModel();

        $perPage = 10;

        $data = [
            'reservas' => $reservaModel->paginate($perPage),
            'pager' => $reservaModel->pager,
        ];

        return view('pages/lists/reservas', $data);
    }
}
