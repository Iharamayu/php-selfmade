<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'birthdate',
        'residence_id',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [];

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

    public function diaries()
    {
        return $this->hasMany(Diary::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id1', 'user_id2');
    }

    public function List()
    {
        return $this->hasMany(Friend::class, 'user_id1')->orWhere('user_id2', $this->id);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'residence_id');
    }
    
}
