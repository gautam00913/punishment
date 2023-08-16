<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricule',
        'firstname',
        'lastname',
        'gender',
        'age',
        'email',
        'phone',
        'picture',
        'userable_id',
        'userable_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    public function name(): Attribute
    {
        return Attribute::make(fn (mixed $value, array $attributes) => $attributes['firstname'] . ' '. $attributes['lastname']);
    }

    public function isAdministractor(): bool
    {
        return $this->userable_type === 'App\Models\Administration';
    }

    public function getAsSmsAttribute(): bool
    {
        return $this->email ? false : true;
    }

    public function getCAgeAttribute(): string
    {
        return $this->age <= 1 ? $this->age . ' an' : $this->age . ' ans';
    }

    public function getCGenderAttribute(): string
    {
        return $this->gender == 'M' ? 'Masculin' : 'Féminin';
    }
}
