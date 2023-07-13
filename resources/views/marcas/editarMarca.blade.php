@extends('layouts.app')

@section('titulo')
    Editar Marca
@endsection
{{-- Directiva para integrar los estilos de dropzon --}}
@push('styles')
    {{-- Estilos de dropzone css --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de edición de marca -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Editar Marca</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
          
            <form action="{{ route('marcas.update', $marca->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="nombre">
                        Nombre
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="nombre" name="nombre" type="text" placeholder="Nombre" value="{{ old('nombre', $marca->nombre) }}">
                    @error('nombre')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="descripcion">
                        Descripción
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="descripcion" name="descripcion" type="text" placeholder="Descripción" value="{{ old('descripcion', $marca->descripcion) }}">
                    @error('descripcion')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="imagen_actual">
                        Imagen actual
                    </label>
                    <div >
                        <img src="{{ asset('uploads/' . $marca->imagen) }}" alt="Imagen de marca" style="max-width: 50px; max-height: 200px;">
                    </div>
                </div>
                
                <div class="mb-5">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="imagen">
                        Cambiar imagen
                    </label>
                    <input type="hidden" name="imagen"  value="{{old('imagen')}}">
                    @error('imagen')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                
                

              <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                  Guardar cambios
                </button>
              </div>
            </form>

            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzoneMarcas" class="dropzone" style="width: 100%; border: none; padding: 0px; align-items: center">
                @csrf
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection