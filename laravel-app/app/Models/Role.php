<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('role')]
class Role extends Model
{
    // attribute users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
}
