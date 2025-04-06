@extends('layouts.app')

@section('titulo')
    @auth
        @if ($tipo === 'seguidores')
            @if ($user->id === auth()->user()->id)
                Seguidores
            @else
                Seguidores de {{ $user->name }}
            @endif
        @elseif ($tipo === 'siguiendo')
            @if ($user->id === auth()->user()->id)
                Siguiendo
            @else
                A quién sigue {{ $user->name }}
            @endif
        @endif
    @endauth

    @guest
        @if ($tipo === 'seguidores')
            Seguidores de {{ $user->name }}
        @else
            A quién sigue {{ $user->name }}
        @endif
    @endguest
@endsection



@section('contenido')
    <div class="w-full max-w-lg p-3  mx-auto">
        @if ($users->count())
            <div class="space-y-3">
                @foreach ($users as $user)
                    <div class="flex bg-white  items-center justify-between p-3 rounded-lg border transition-colors">
                        <div class="flex items-center justify-between w-[90%] mx-auto gap-3">
                            <div class="flex items-center gap-3">
                                @if ($user->imagen)
                                    <img src="{{ asset('perfiles/' . $user->imagen) }}"
                                        alt="Imagen de perfil del usuario {{ $user->username }}" class="rounded-full size-10">
                                @else
                                    <img src="{{ asset('img/usuario.svg') }}"
                                        alt="Imagen de perfil del usuario {{ $user->username }}"
                                        class="rounded-full size-10">
                                @endif
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    <a href="{{ route('posts.index', $user->username) }}">
                                        <p
                                            class="text-sm text-muted-foreground border-b border-transparent  hover:border-gray-500 transition-all ease-in duration-300">
                                            {{ '@' . $user->username }}</p>
                                    </a>
                                </div>
                            </div>
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
                    <div class="my-10">
                        {{ $users->links('pagination::simple-tailwind') }}
                    </div>
                @endforeach
            </div>
        @else
            @if ($tipo === 'siguiendo')
                <div class="text-center text-gray-500 py-8 text-muted-foreground">No estás siguiendo a nadie en este
                    momento.
                </div>
            @else
                <div class="text-center text-gray-500 py-8 text-muted-foreground">No tienes seguidores aun.
                </div>
            @endif
        @endif
    </div>
@endsection
