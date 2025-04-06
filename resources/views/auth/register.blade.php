@extends('layouts.app')
@section('titulo')
    Registrate en Devstagram
@endsection



@section('contenido')
    <div class="lg:flex lg:justify-center lg:gap-10 p-5 lg:items-center ">
        <div class="mb-10 lg:w-6/12 lg:mb-0">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de registro" class="rounded shadow-xl">
        </div>

        <div class="lg:w-4/12 bg-white p-6 rounded shadow-xl">
            <form class="space-y-5" action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="space-y-1">
                    <label for="name" class="block font-semibold text-gray-500">Nombre</label>
                    <input type="text" id="name" name="name"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 @error('name')
                            border-red-500
                        @enderror"
                        placeholder="Tu nombre" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1">
                    <label for="username" class="block font-semibold text-gray-500">Usuario</label>
                    <input type="text" id="username" name="username"
                        class="w-full border  rounded p-2 focus:outline-none focus:border-blue-500
                        @error('username')
                            border-red-500
                        @enderror"
                        placeholder="Tu nombre de usuario" value="{{ old('username') }}">
                    @error('username')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1">
                    <label for="email" class="block font-semibold text-gray-500">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border  rounded p-2 focus:outline-none focus:border-blue-500
                        @error('email')
                            border-red-500
                        @enderror"
                        placeholder="Tu email de registro" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1">
                    <label for="password" class="block font-semibold text-gray-500">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="w-full border  rounded p-2 focus:outline-none focus:border-blue-500  @error('password')
                            border-red-500
                        @enderror"

                        placeholder="Tu contraseña de registro">
                        @error('password')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1">
                    <label for="password_confirmation" class="block font-semibold text-gray-500">Repetir Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-blue-500"
                        placeholder="Repite tu contraseña">
                </div>
                <input type="submit" value="Crear cuenta"
                    class="w-full bg-blue-500 text-white font-semibold rounded p-2 hover:bg-blue-600 cursor-pointer transition-all duration-200 ease-linear"> 
            </form>
        </div>

    </div>
@endsection
