@extends('layouts.app')
@section('titulo')
    Inicia Sesion en Devstagram
@endsection



@section('contenido')
    <div class="lg:flex lg:justify-center lg:gap-10 p-5 lg:items-center ">
        <div class="mb-10 lg:w-6/12 lg:mb-0">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login" class="rounded shadow-xl">
        </div>

        <div class="lg:w-4/12 bg-white p-6 rounded shadow-xl">
            <form class="space-y-5" method="POST" action="{{ route('login') }}" novalidate id="login-form">
                @csrf
                @if (session('mensaje'))
                    <p class="text-center text-red-500">{{ session('mensaje') }}</p>
                @endif
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

                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-sm text-gray-500">Mantener mi sesion
                        abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesion"
                    class="w-full bg-blue-500 text-white font-semibold rounded p-2 hover:bg-blue-600 cursor-pointer transition-all duration-200 ease-linear">
            </form>
        </div>

    </div>
@endsection
