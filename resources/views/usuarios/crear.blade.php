@extends('layouts.app')


@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection

@section('estilos2')
<!-- Se incluyen las librerías y estilos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('titulo')
    Agregar cliente
@endsection


@section('contenido_top')
    <div
        class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de registro de categoría -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Registrar</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <form action="{{route('imagenUsuario.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone " style="width: 100%; border:none;padding:0px; align-items:center">
                @csrf
            </form>

            <form action="{{ route('usuario.store') }}" method="POST" novalidate>
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" required>
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                

                <div class="mb-4">
                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('apellido') border-red-500 @enderror" value="{{old('apellido')}}" required>
                    @error('apellido')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('username') border-red-500 @enderror" value="{{old('username')}}" required>
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('telefono') border-red-500 @enderror" value="{{old('telefono')}}" required>
                    @error('telefono')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                    <input type="email" id="correo" name="correo" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('correo') border-red-500 @enderror" value="{{old('correo')}}" required>
                    @error('correo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">password:</label>
                    <input type="password" id="password" name="password" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('password') border-red-500 @enderror" value="{{old('password')}}" required>
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado del usuario:</label>
                    <select name="estado" id="estado" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('estado') border-red-500 @enderror">
                        <option value="">-- Seleccione un estado --</option>
                        <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="desactivo" {{ old('estado') == 'desactivo' ? 'selected' : '' }}>Desactivo</option>
                    </select>
                    @error('estado')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rol" class="block text-sm font-medium text-gray-700">Rol:</label>
                    <select name="rol" id="rol" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-black/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('rol') border-red-500 @enderror">
                        <option value="">Seleccione un rol</option>
                        <option value="vendedor" {{ old('rol') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    </select>
                    @error('rol')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <br>
                

                <!--Agregar campo oculto para guardar el valor de la imagen-->
                <div class="mb-5">
                    <input type="hidden" name="imagen"  value="{{old('imagen')}}">
                    @error('imagen')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                <div class="flex justify-center">
                    <button type="button" id="btnCancelar" class="btnCancelar mr-2 px-4 py-2 text-sm font-medium text-gray-600 bg-transparent rounded-md hover:text-gray-800 focus:outline-none">
                        Cancelar
                    </button>
                    <button type="submit" class="btnAceptar ml-2 px-6 py-3 text-base font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">
                        Registrar
                    </button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script>
  document.getElementById('btnCancelar').addEventListener('click', function() {
    // Muestra el SweetAlert de confirmación
    Swal.fire({
      title: '¿Estás seguro?',
      text: 'Si cancelas, los datos ingresados se perderán.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#8078C1',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, estoy seguro',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirecciona al usuario a la página "tablaProductos"
        window.location.href = '{{ route('tablaProductos') }}';
      }
    });
  });
</script>

@endsection

