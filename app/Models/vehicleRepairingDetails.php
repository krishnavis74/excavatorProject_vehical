<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicleRepairingDetails extends Model
{
    use HasFactory;

    protected $table = 'tbl_vehicle_repairing_details';
    protected $primaryKey = 'code';
}
