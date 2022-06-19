<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    ];

    /**
     * A user has many posts
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'author_id');
    }

    /**
     * A user has many comments
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'author_id');
    }

    public function can_post()
    {
        $role = $this->role;
        if ($role === 'author' || $role === 'admin') {
            return true;
        }

        return false;
    }

    public function is_admin()
    {
        $role = $this->role;
        if ($role === 'admin') {
            return true;
        }

        return false;
    }
}
