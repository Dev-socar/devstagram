@extends('layouts.app')
@section('titulo')
    Edita tu perfil {{ $user->username }}
   <div class="flex justify-center mt-5">
     @if ($user->imagen)
        <img class="rounded-full size-40" src="{{ asset('perfiles') . '/' . $user->imagen }}" alt="Imagen del usuario">
    @else
        <img src="{{ asset('img/usuario.svg') }}" class="size-40" alt="Imagen del usuario">
    @endif
   </div>
@endsection

@section('contenido')
    @if (session('error'))
        <div class="absolute top-20 right-2 w-fit shadow" id="toast">
            <p class=" p-3 rounded text-center bg-red-500 text-white text-lg ">{{ session('error') }}</p>
        </div>
    @endif

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block  text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}" />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block  text-gray-500 font-bold">Email</label>
                    <input type="text" id="email" name="email" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block  text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*"
                        class="border p-3 w-full rounded-lg" />
                </div>
                <input type="submit" value="Actualizar perfil"
                    class="bg-blue-600 hover:bg-blue-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full" />
            </form>
        </div>
    </div>
@endsection
