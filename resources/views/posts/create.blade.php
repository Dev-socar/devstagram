@extends('layouts.app')
@section('titulo')
    Crea una nueva publicacion
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10 ">
            <form action="{{ route('imagenes.store') }}" enctype="multipart/form-data" method="POST" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-80 flex flex-col justify-center items-center rounded">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white  mt-10 md:mt-0 rounded shadow-xl">
            <form action="{{ route('posts.store', auth()->user()->username) }}" method="POST" novalidate>
                @csrf
                <div class="space-y-1 mb-5">
                    <label for="titulo" class="block font-semibold text-gray-500">Titulo</label>
                    <input type="text" id="titulo" name="titulo"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 @error('titulo')
                            border-red-500
                        @enderror"
                        placeholder="Titulo de la publicacion" value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1 mb-5">
                    <label for="descripcion" class="block font-semibold text-gray-500">Descripcion</label>
                    <textarea type="text" id="descripcion" name="descripcion" placeholder="Descripcion de la publicacion"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 @error('descripcion')
                            border-red-500
                        @enderror"> {{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="hidden" name="imagen" id="imagen" value="{{old('imagen')}}" />
                    @error('imagen')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear publicacion"
                    class="w-full bg-blue-500 text-white font-semibold rounded p-2 hover:bg-blue-600 cursor-pointer transition-all duration-200 ease-linear">
            </form>
        </div>
    </div>
@endsection
