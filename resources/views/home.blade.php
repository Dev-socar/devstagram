@extends('layouts.app')
@section('titulo')
    @auth
        Publicaciones de tus seguidores
    @endauth
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
            
@endsection
