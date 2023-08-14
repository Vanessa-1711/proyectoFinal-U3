@extends('layouts.app')

@section('estilos')
<!-- Enlace al archivo CSS de Dropzone -->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<!-- Enlace al archivo JS de Dropzone -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection

@section('estilos2')
<!-- Agregar librerías y estilos requeridos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('titulo')
    Editar Proveedor
@endsection

@section('contenido_top')
<!-- Fondo para la sección superior -->
<div class="absolute bg-y-50 w-full top-0 min-h-75">
    <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
</div>
@endsection

@section('contenido')
<!-- Contenedor principal -->
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario para registrar un nuevo producto -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <!-- Encabezado del formulario -->
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Editar Proveedor</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <!-- Formulario de registro de proveedor con Dropzone para la imagen -->
            <form action="{{route('imagenProveedor.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone" style="width: 100%; border:none;padding:0px; align-items:center">
                @csrf
            </form>

            <!-- Formulario para registrar los detalles del proveedor -->
            <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <!-- Mensaje de confirmación de éxito o error -->
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <!-- Campo para mostrar la imagen actual del proveedor -->
                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{ $proveedor->fotografia }}">
                    
                    <!-- Mensaje de error en caso de haber problemas con la imagen -->
                    @error('imagen')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                <!-- Campo para ingresar el nombre del proveedor -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nombre') border-red-500 @enderror" value="{{ old('nombre', $proveedor->nombre) }}" required>
                    <!-- Mensaje de error en caso de haber problemas con el nombre -->
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <!-- Campo para ingresar el código del proveedor -->
                <div class="mb-4">
                    <label for="codigo" class="block text-sm font-medium text-gray-700">Código:</label>
                    <input type="text" id="codigo" name="codigo" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('codigo') border-red-500 @enderror" value="{{old('codigo', $proveedor->codigo)}}" required>
                    <!-- Mensaje de error en caso de haber problemas con el código -->
                    @error('codigo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <!-- Campos para país, estado y ciudad -->
                <div class="mb-4">
                    <label for="country" class="block text-sm font-medium text-gray-700">País:</label>
                    <select name="pais" id="country" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                        <option value="">-- Seleccione un país --</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}" {{ $country->id == old('country', $proveedor->pais) ? 'selected' : '' }}>
                            {{ $country->name }}
                          </option>
                           
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado:</label>
                    <select name="estado" id="state" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-black/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                        <option value="">Seleccione un estado</option>
                        @foreach($states as $state)
                        <option value="{{ $state->state_id}}" {{ $state->state_id == old('state', $proveedor->estado) ? 'selected' : '' }} >
                            {{ $state->state_name }}
                          </option>
                        @endforeach
  
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad:</label>
                    <input type="text" name="ciudad" id="ciudad" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('ciudad') border-red-500 @enderror" value="{{old('ciudad', $proveedor->ciudad)}}" required>
                    @error('ciudad')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <!-- Campo para ingresar el teléfono del proveedor -->
                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('telefono') border-red-500 @enderror" value="{{old('telefono', $proveedor->telefono)}}" required>
                    <!-- Mensaje de error en caso de haber problemas con el teléfono -->
                    @error('telefono')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <!-- Campo para ingresar el correo del proveedor -->
                <div class="mb-4">
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                    <input type="email" id="correo" name="correo" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('correo') border-red-500 @enderror" value="{{old('correo', $proveedor->correo)}}" required>
                    <!-- Mensaje de error en caso de haber problemas con el correo -->
                    @error('correo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <!-- Botones para cancelar y registrar el proveedor -->
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

<!-- Script para cargar la librería Select2 y aplicarla a elementos con la clase select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<!-- Script para mostrar una alerta de confirmación antes de cancelar el registro -->
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
        window.location.href = '{{ route('proveedores') }}';
      }
    });
  });
</script>

@endsection
