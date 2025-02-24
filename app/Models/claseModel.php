<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseModel extends Model
{
    protected $table = 'clase';     protected $primaryKey = 'id'; 

    protected $useTimestamps = true;
    
    protected $allowedFields = ['id_monitor', 'duracion', 'capacidad', 'fecha_hora']; 
    
    protected $perPage = 10;

}