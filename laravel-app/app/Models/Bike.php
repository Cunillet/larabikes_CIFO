<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;
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

    /**
     * Returns the related user
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
