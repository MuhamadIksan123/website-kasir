<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama',
        'username',
        'password',
        'role'
    ];
}
