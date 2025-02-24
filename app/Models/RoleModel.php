<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nombre'];

    protected $perPage = 10;

    

}