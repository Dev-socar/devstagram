<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function followers(User $user)
    {
        return view('seguidores.index', [
            'user' => $user,
            'tipo' => 'seguidores', 
            'users' => $user->followers()->paginate(10)
        ]);
    }

    public function following(User $user)
    {
        return view('seguidores.index', [
            'user' => $user,
            'tipo' => 'siguiendo', 
            'users' => $user->following()->paginate(10)
        ]);
    }
}
