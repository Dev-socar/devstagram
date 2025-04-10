<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
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
        'name',
        'email',
        'password',
        'username'
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

    public function posts()
    {

        return $this->hasMany(Post::class); // one to many relationship
    }
    public function likes()
    {
        return $this->hasMany(Like::class); // one to many relationship
    }

    // Almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); // many to many relationship
    }

    //Almacenar los que seguimos
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); // many to many relationship
    }

    //comprobar si seguimos a un usuario
    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }
}
