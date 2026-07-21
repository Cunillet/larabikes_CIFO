<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWithImage(Builder $query): Builder
    {
        return $query->whereNotNull('image')
                     ->where('image', '!=', '');
    }

    public function scopeLatest(Builder $query, int $limit = 4): Builder
    {
        return $query->orderBy('created_at', 'desc')
                     ->limit($limit);
    }

    public static function getLatestWithImage(int $limit = 4)
    {
        return self::withImage()
                   ->latest()
                   ->limit($limit)
                   ->get();
    }
}
