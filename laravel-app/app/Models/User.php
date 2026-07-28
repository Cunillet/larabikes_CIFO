<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['display_name', 'name', 'email', 'birth_date', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the user's birth date with correct format.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
        );
    }


    public function birthDateForInput(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['birth_date']
                ? Carbon::parse($attributes['birth_date'])->format('Y-m-d')
                : null,
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }

    /**
     * Get User related bikes
     * 
     * @return HasMany
     */
    public function bikes(): HasMany {
        return $this->hasMany(Bike::class);
    }

    public function contactData()
    {
        return $this->hasOne(ContactData::class);
    }

    // phone accessor
    public function getPhoneAttribute()
    {
        return $this->contactData?->phone;
    }

    // address accessor
    public function getAddressAttribute()
    {
        return $this->contactData?->address;
    }

    // address accessor
    public function getCityAttribute()
    {
        return $this->contactData?->city;
    }

    // country_id accessor
    public function getCountryIdAttribute()
    {
        return $this->contactData?->country_id;
    }

    // country accessor
    public function getCountryAttribute()
    {
        return $this->contactData?->country;
    }

    // attribute roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function hasAllRoles(string|array $roleNames): bool
    {
        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }
        $foundRoles = 0;
        foreach($this->roles as $role) {
            if (in_array($role->role, $roleNames)) {
                $foundRoles++;
            }
        }
        if ($foundRoles < count($roleNames)) {
            return false;
        }
        return true;
    }

    public function hasRole(string|array $roleNames): bool
    {
        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }
        foreach($this->roles as $role) {
            if (in_array($role->role, $roleNames)) {
                return true;
            }
        }
        return false;
    }

    public function isOwner(Bike $bike): bool
    {
        return $bike->user_id === $this->id;
    }
}
