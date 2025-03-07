<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nombre', 'email', 'contraseña', 'telefono', 'rol', 'disabled'];

    protected $perPage = 10;

    public function findByEmail(string $email)
    {
        return $this->where(['email' => $email])->first();
    }
}


