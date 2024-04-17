<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'merk',
        'model',
        'no_plat',
        'cost_per_day',
        'created_by',
        'available',
        'image'
    ];
}
