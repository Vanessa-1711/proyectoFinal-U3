@extends('layouts.app')

@section('titulo')
    Subcategorías
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Formulario Agregar Subcategoría -->
        <form method="POST" action="{{ route('subcategorias.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="categoria_id">
                    Categoría
                </label>
                <select name="categoria_id" id="categoria_id" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('categoria_id') border-red-500 @enderror">
                    <option value="">-- Seleccione una categoría --</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="nombre">
                    Nombre
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" id="nombre" name="nombre" type="text" placeholder="Código">
                @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="codigo">
                    Código de Subcategoría
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('codigo') border-red-500 @enderror" value="{{old('codigo')}}" id="codigo" name="codigo" type="text" placeholder="Código">
                @error('codigo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
            </div>

            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="descripcion">
                    Descripción
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('descripcion') border-red-500 @enderror" value="{{old('descripcion')}}" id="descripcion" name="descripcion" type="text" placeholder="Descripción">
                @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" >
                    Agregar Subcategoría
                </button>
            </div>
        </form>
    </div>
@endsection
