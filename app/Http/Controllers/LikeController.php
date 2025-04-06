<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request,User $user, Post $post)
    {
       
        return back()->with('mensaje', 'Has dado like a la publicación');
    }

    public function destroy(Request $request,User $user, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        
        return back();
    }
}
