<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bike extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'model',
        'kms',
        'price',
        'registered',
        'image',
    ];
}
