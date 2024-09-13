<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicleRepairing extends Model
{
    use HasFactory;  

    protected $table = 'tbl_vehicle_repairing';
    protected $primaryKey = 'code';
}
