<?php

namespace App\Models;

use CodeIgniter\Model;

class PistaModel extends Model
{
    protected $table = 'pista';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nombre', 'estado'];

    protected $perPage = 10;

   

}