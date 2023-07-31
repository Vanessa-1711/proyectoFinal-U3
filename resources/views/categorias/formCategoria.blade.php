@extends('layouts.app')

@section('titulo')
    Agregar Categoría
@endsection

@section('contenido_top')
    <!-- Fondo de encabezado -->
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
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
          <h6 class="dark:text-white">Registrar Categoría</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <!-- Formulario para registrar la categoría -->
            <form action="{{route('formCategorias')}}" method="POST" novalidate>
                @csrf

                <!-- Mensaje de error si la sesión contiene 'mensaje' -->
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <!-- Campo de entrada para el nombre -->
                    <input type="text" id="nombre" name="nombre" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" required>
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror  
                </div>
                <div class="mb-6">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <!-- Campo de entrada para la descripción -->
                    <textarea id="descripcion" name="descripcion"  class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid  bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror" value="{{old('descripcion')}}" required></textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror  
                </div>
                <div class="mb-4">
                    <label for="codigo" class="block text-sm font-medium text-gray-700">Código:</label>
                    <!-- Campo de entrada para el código -->
                    <input type="text" id="codigo" name="codigo" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('codigo') border-red-500 @enderror" value="{{old('codigo')}}" required>
                    @error('codigo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <!-- Botón "Cancelar" -->
                    <button type="button" id="btnCancelar" class="btnCancelar ml-2 px-6 py-3 text-base font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">
                        Cancelar
                    </button>
                    <!-- Botón "Registrar" -->
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

<!-- Script para el funcionamiento del select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<!-- Script para el manejo de modales -->
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
        window.location.href = '{{ route('categorias') }}';
      }
    });
});
</script>
@endsection
