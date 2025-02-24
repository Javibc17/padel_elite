<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseusuarioModel extends Model
{
    protected $table = 'clasesusuario';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nombre_monitor', 'fecha_hora'];

    protected $perPage = 10;

    public function findByEmail(string $email)
    {
        return $this->where(['email', $email])->first();
    }

}