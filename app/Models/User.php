<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens,SoftDeletes, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'email',
        "username",
		'remember_token',
		'updated_at',
		'status',
		'user_role',
        "device_name",
        'full_name',
        'country',
        'phone_number',
        'api_token',
        'birthday',
        'password'

	];
    protected $dates = ['deleted_at'];
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

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class , 'favorites');
    }
    public function point()
    {
        return $this->hasOne(Point::class);
    }
    public function observers()
    {
        return $this->hasMany(Observer::class);
    }
}
