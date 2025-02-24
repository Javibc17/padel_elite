<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_cliente', 'id_monitor', 'id_pista', 'id_clase', 'fecha','hora', 'tipo'];

    protected $perPage = 10;

    

}