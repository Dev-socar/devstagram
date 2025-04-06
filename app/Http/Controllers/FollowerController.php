<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(Request $request, User $user)
    {
        $user->followers()->attach(auth()->user()->id);
        return back()->with('mensaje', 'Ahora sigues a ' . $user->username);
    }
    public function destroy(Request $request, User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back()->with('mensaje', 'Has dejado de seguir a ' . $user->username);
    }
}
