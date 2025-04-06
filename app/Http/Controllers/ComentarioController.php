<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        // Validate the request
        $request->validate([
            'comentario' => 'required|string|max:255',
        ]);

        // Create a new comment
       Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        // Redirect back to the post
        return back()->with('mensaje', 'Comentario publicado correctamente');

    }
}
