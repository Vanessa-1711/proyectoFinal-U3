@extends('layouts.app')

@section('titulo')
    Editar Cliente
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
  <!-- Formulario de edición de cliente -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Editar Cliente</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
          
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" enctype="multipart/form-data" novalidate>
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
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="nombre" name="nombre" type="text" placeholder="Nombre" value="{{ old('nombre', $cliente->nombre) }}">
                </div>
                
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="codigo">
                        Código
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="codigo" name="codigo" type="text" placeholder="Código" value="{{ old('codigo', $cliente->codigo) }}">
                </div>
                
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="empresa">
                        Empresa
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="empresa" name="empresa" type="text" placeholder="Empresa" value="{{ old('empresa', $cliente->empresa) }}">
                </div>
                
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="telefono">
                        Teléfono
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="telefono" name="telefono" type="text" placeholder="Teléfono" value="{{ old('telefono', $cliente->telefono) }}">
                </div>
                
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="correo">
                        Correo
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="correo" name="correo" type="email" placeholder="Correo" value="{{ old('correo', $cliente->correo) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="fotografia_actual">
                        Fotografia actual
                    </label>
                    <div style="background-image: url('{{ $imagen_url }}'); width: 100px; height: 100px; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="fotografia">
                        Cambiar fotografia
                    </label>
                    <input type="file" id="fotografia" name="fotografia" class="form-control">
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