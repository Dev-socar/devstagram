<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']); // one to many relationship
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class); // one to many relationship
    }
    public function likes()
    {
        return $this->hasMany(Like::class); // one to many relationship
    }
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id); // check if the user has liked the post
    }
}
