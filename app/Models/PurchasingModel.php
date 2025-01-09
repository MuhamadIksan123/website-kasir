<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchasingModel extends Model
{
    protected $table            = 'purchasing';
    protected $allowedFields    = [
        'nama'
    ];
}
