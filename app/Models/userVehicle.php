<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userVehicle extends Model
{
    use HasFactory;

    protected $table = 'user_vehicle';
    protected $primaryKey = 'code';
}
