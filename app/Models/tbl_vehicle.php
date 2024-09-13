<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_vehicle extends Model
{
    use HasFactory;
    protected $table='tbl_vehicle';
    protected $primaryKey = 'code';
}
