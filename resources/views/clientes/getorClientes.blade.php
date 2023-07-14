@extends('layouts.app')

@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

@endsection

@section('titulo')
    Agregar Cliente
@endsection


@section('contenido_top')
    <div
        class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de registro de categoría -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Registrar Cliente</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <form action="{{route('imagenes.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone " style="width: 100%; border:none;padding:0px; align-items:center">
                @csrf
            </form>
            <form method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data">
              @csrf

              <div class="mb-4">
                  <label class="block text-grey-darker text-sm font-bold mb-2" for="nombre">
                      Nombre
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" id="nombre" name="nombre" type="text" placeholder="Nombre" >
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

              <div class="mb-4">
                  <label class="block text-grey-darker text-sm font-bold mb-2" for="codigo">
                      Código
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('nombre') border-red-500 @enderror" value="{{old('codigo')}}" id="codigo" name="codigo" type="text" placeholder="Código" >
                  @error('codigo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

              <div class="mb-4">
                  <label class="block text-grey-darker text-sm font-bold mb-2" for="empresa">
                      Empresa
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('empresa') border-red-500 @enderror" value="{{old('empresa')}}" id="empresa" name="empresa" type="text" placeholder="Empresa">
                  @error('empresa')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

              <div class="mb-4">
                  <label class="block text-grey-darker text-sm font-bold mb-2" for="telefono">
                      Teléfono
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('telefono') border-red-500 @enderror" value="{{old('telefono')}}" id="telefono" name="telefono" type="text" placeholder="Teléfono">
                    @error('telefono')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
              </div>

              <div class="mb-4">
                  <label class="block text-grey-darker text-sm font-bold mb-2" for="correo">
                      Correo
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('correo') border-red-500 @enderror" value="{{old('correo')}}" id="correo" name="correo" type="text" placeholder="Correo">
                    @error('correo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
              </div>

              <div class="mb-5">
                    <input type="hidden" name="imagen"  value="{{old('imagen')}}">
                    @error('imagen')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                  Registrar Cliente
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

