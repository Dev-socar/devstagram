@extends('layouts.app')

@section('titulo')
    {{ $user->username }}
@endsection


@section('contenido')
    @if (session('mensaje'))
        <div class="absolute top-20 right-2 w-fit shadow" id="toast">
            <p class=" p-3 rounded text-center bg-green-500 text-white text-lg ">{{ session('mensaje') }}</p>
        </div>
    @endif
    <div class="flex justify-center">

        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class=" w-8/12 lg:w-6/12 px-5">
                @if ($user->imagen)
                    <img class="rounded-full" src="{{ asset('perfiles') . '/' . $user->imagen }}" alt="Imagen del usuario">
                @else
                    <img src="{{ asset('img/usuario.svg') }}" alt="Imagen del usuario">
                @endif
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        @if (auth()->user()->id === $user->id)
                            <a href="{{ route('perfil.index', $user) }}"
                                class="text-gray-600 hover:text-gray-700 font-bold text-sm ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <a href={{ route('users.followers', $user->username) }}>
                    <p class="text-sm text-gray-800 mb-3 font-bold capitalize mt-5">
                        <span class="font-normal">{{ $user->followers->count() }}</span>
                        @choice('seguidor|seguidores', $user->followers->count())
                    </p>
                </a>

                <a href={{ route('users.following', $user->username) }}>
                    <p class="text-sm text-gray-800 mb-3 font-bold capitalize"><span
                            class="font-normal">{{ $user->following->count() }}</span>
                        Siguiendo
                    </p>
                </a>

                <p class="text-sm text-gray-800 mb-3 font-bold capitalize"><span
                        class="font-normal">{{ $posts->count() }}</span> @choice('publicacion|publicaciones', $posts->count()) </p>
                @auth
                    @if (auth()->user()->id !== $user->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form method="POST" action="{{ route('users.follow', $user) }}">
                                @csrf
                                <input type="submit" value="Seguir"
                                    class="bg-blue-600 text-white font-bold text-xs py-1 px-3 rounded-lg cursor-pointer hover:bg-blue-700">
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.unfollow', $user) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Dejar de seguir"
                                    class="bg-red-600 text-white font-bold text-xs py-1 px-3 rounded-lg cursor-pointer hover:bg-red-700">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>

        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Mis Publicaciones</h2>
        <x-listar-post :posts="$posts" />
    @endsection
