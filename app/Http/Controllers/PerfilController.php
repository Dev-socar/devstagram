<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            return redirect()
                ->route('perfil.index', $user->username)
                ->with('mensaje', 'No tienes permiso para editar este perfil');
        }
        return view('perfil.index', [
            'user' => $user,
        ]);
    }
    public function store(Request $request, User $user)
    {

        //modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,facebook,instagram,tiktok,editar-perfil'],
        ]);
        //validar email
        if ($request->email) {
            $this->validate($request, [
                'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id, 'not_in:twitter,facebook,instagram,tiktok,editar-perfil'],
            ]);
        }

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($user->imagen && file_exists(public_path('perfiles/' . $user->imagen))) {
                unlink(public_path('perfiles/' . $user->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }


        //guardar los cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //redireccionar
        return redirect()
            ->route('posts.index', $usuario->username)
            ->with('mensaje', 'Se guardaron los cambios');
    }
}
