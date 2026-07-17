<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'color',
        'kms',
        'price',
        'registered',
        'bike_plate',
        'image',
        'description',
        'buy_date',
        'horsepower',
    ];
    protected $attributes = [
        'buy_date' => '2000-01-01',
    ];
}
