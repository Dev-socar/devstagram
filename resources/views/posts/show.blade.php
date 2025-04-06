@extends('layouts.app')
@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        @if (session('mensaje'))
            <div class="absolute top-20 right-2 w-fit shadow" id="toast">
                <p class=" p-3 rounded text-center bg-green-500 text-white text-lg ">{{ session('mensaje') }}</p>
            </div>
        @endif
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="pt-3 flex items-center gap-2">
                @auth
                    <livewire:like-post :post="$post">
                @endauth
                   
            </div>
            <div>
                <a href="{{ route('posts.index', $post->user->username) }}"
                    class="font-bold">{{ $post->user->username }}</a>
                <p class="text-xs text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                <div class="mt-5">
                    <p class="text-sm text-gray-600">{{ $post->descripcion }}</p>
                </div>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', ['user' => $user->username, 'post' => $post]) }}" method="POST"
                        class="mt-5">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Post"
                            class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer uppercase font-bold  p-3 text-white rounded-lg">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow-lg bg-white p-5 mb-5">
                <div>
                    @if ($post->comentarios->count())
                        <p class="text-xl font-bold mb-4 text-center">Comentarios ({{ $post->comentarios->count() }})</p>
                        @foreach ($post->comentarios as $comentario)
                            <div class="mb-5 border-b border-gray-300 pb-5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('posts.index', $comentario->user->username) }}">
                                        <div class="flex items-center gap-2">
                                            @if ($comentario->user->imagen)
                                                <img src="{{ asset('perfiles') . '/' . $comentario->user->imagen }}"
                                                    alt="Imagen de perfil del usuario {{ $comentario->user->username }}"
                                                    class="rounded-full size-7">
                                            @else
                                                <img src="{{ asset('img/usuario.svg') }}"
                                                    alt="Imagen de perfil del usuario {{ $comentario->user->username }}"
                                                    class="rounded-full size-7">
                                            @endif
                                            <p class="font-bold">{{ $comentario->user->username }} </p>
                                        </div>
                                    </a>
                                    <p>{{ $comentario->comentario }}</p>
                                </div>
                                <p class="text-xs text-gray-600">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        @auth
                            <p class="text-base text-gray-500 text-center">Se el primero en comentar</p>
                        @endauth
                    @endif

                </div>
                @auth
                    <form action="{{ route('comentarios.store', ['post' => $post->id, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block text-gray-500 font-bold">Comentario</label>
                            <textarea id="comentario" name="comentario" placeholder="Escribe un comentario"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                    </form>
                @endauth
                @guest
                    <p class="text-base text-gray-500 text-center"><a href="{{ route('login') }}"
                            class="text-base  text-gray-700 text-center">Inicia sesión </a> para comentar o indicar que te
                        gusta.</p>

                @endguest

            </div>
        </div>

    </div>
@endsection
