<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'location', 'country_id', 'length', 'turns', 'capacity', 'image', 'description'])]
class Circuit extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
