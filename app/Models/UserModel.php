<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nombre', 'telefono', 'email', 'contraseña', 'created_at'];

    protected $perPage = 10;



}