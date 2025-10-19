<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
        'auth_token',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'auth_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'is_admin' => 'boolean',
    ];

    // Relationships
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}