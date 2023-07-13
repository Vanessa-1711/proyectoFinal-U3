@extends('layouts.app')

@section('titulo')
    Editar Subcategoría
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de edición de subcategoría -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Editar Subcategoría</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
          
            <form action="{{ route('subcategoria.update', $subcategoria->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="categoria">
                        Categoría
                    </label>
                    <select name="categoria" id="categoria" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('categoria') border-red-500 @enderror" required>
                        <option value="">{{ $subcategoria->categoria->nombre}}</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->nombre }}" {{ old('categoria') == $categoria->nombre ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
    
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="codigo">
                        Código de Subcategoría
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="codigo" name="codigo" type="text" value="{{ $subcategoria->codigo }}">
                </div>
    
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="descripcion">
                        Descripción
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="descripcion" name="descripcion" type="text" value="{{ $subcategoria->descripcion }}">
                </div>
              <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                  Guardar cambios
                </button>
              </div>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
