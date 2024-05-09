<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['description', 'amount'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}