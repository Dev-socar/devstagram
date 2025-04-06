<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>Devstagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')


    @livewireStyles
</head>

<body class="bg-gray-200">
    <header class="p-5 border-b bg-blue-600 shadow">
        <div class="container mx-auto flex flex-col gap-5 md:gap-0 md:flex-row md:justify-between md:items-center">
            <a href="{{route('home')}}">
                    <h1 class="text-white text-3xl font-bold">Devstagram</h1>
                </a>
            @auth
                
                <nav class="flex gap-3 flex-col md:flex-row">
                    <a href="{{ route('posts.create', auth()->user()->username) }}"
                        class="flex items-center gap-2 text-blue-600 py-1 px-2 rounded text-sm bg-white uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        Crear
                    </a>


                    <a class="text-gray-100 py-1 px-2 rounded text-sm transition-all duration-300 ease-linear"
                        href="{{ route('posts.index', auth()->user()->username) }}">Hola:
                        <span class="font-bold normal-case">{{ auth()->user()->username }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" value="Cerrar Sesion"
                            class="text-gray-100 py-1 px-2 rounded cursor-pointer
                    uppercase text-sm transition-all duration-300 ease-linear hover:bg-white hover:text-blue-600">
                    </form>
                </nav>
            @endauth

            @guest
                
                <nav class="flex gap-3">
                    <a class="text-gray-100 py-1 px-2 rounded uppercase text-sm transition-all duration-300 ease-linear hover:bg-white hover:text-blue-600"
                        href="{{ route('login') }}">Login</a>
                    <a class="text-gray-100 py-1 px-2 rounded
                    uppercase text-sm transition-all duration-300 ease-linear hover:bg-white hover:text-blue-600"
                        href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            @endguest


        </div>
    </header>

    <main class="mx-auto my-10 container">
        <h2 class="text-3xl font-semibold text-center mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="text-center mt-10 p-5 text-gray-500 font-bold uppercase">
        Devstagram - Todos los derechos reservados &copy; {{ now()->year }}
    </footer>

    @livewireScripts
</body>

</html>

