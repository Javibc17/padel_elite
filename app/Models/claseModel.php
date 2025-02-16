<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseModel extends Model
{
    protected $table = 'clase'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    protected $allowedFields = ['id_monitor', 'duracion', 'capacidad', 'fecha_hora']; // Campos permitidos para operaciones CRUD

    // Puedes agregar métodos personalizados aquí si es necesario
}