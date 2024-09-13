<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiclewise_document extends Model
{
    use HasFactory;

    protected $table="vehiclewise_document";
    protected $primaryKey="code";
}
