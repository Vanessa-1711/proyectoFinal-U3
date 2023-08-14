@extends('layouts.app')

@section('titulo')
    Marcas
@endsection

{{-- Directiva para integrar los estilos de dropzone --}}
@section('estilos')
    {{-- Estilos de dropzone css --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- Agregar estilos adicionales relacionados con esta página aquí -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <!-- Agregar cualquier script adicional relacionado con dropzone aquí -->
@endsection

@section('contenido_top')
    <!-- Contenido adicional para la parte superior de la página -->
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
    <!-- Formulario Agregar Marca -->
    <div class="bg-white rounded-lg shadow-xl">
        <div class="p-6">
            <!-- Dropzone para subir imágenes -->
            <form action="{{route('imagenesMarca.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone" style="width: 100%; border: none; padding: 0px; align-items: center">
                @csrf
            </form>
            <!-- Formulario para crear una nueva marca -->
            <form method="POST" action="{{ route('marcas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <!-- Campo de entrada para el nombre de la marca -->
                    <input type="text" name="nombre" id="nombre" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" placeholder="Nombre" >
                    @error('nombre')
                        <!-- Mostrar mensaje de error para el campo de nombre -->
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <!-- Área de texto para la descripción de la marca -->
                    <textarea id="descripcion" name="descripcion"  class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid  bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror" >{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <!-- Mostrar mensaje de error para el campo de descripción -->
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror  
                </div>

                <!-- Agregar campo oculto para guardar el valor de la imagen -->
                <div class="mb-5">
                    <!-- Campo oculto para almacenar el valor de la imagen -->
                    <input type="hidden" name="imagen"  value="{{old('imagen')}}">
                    @error('imagen')
                        <!-- Mostrar mensaje de error para el campo de imagen -->
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="flex justify-center">
                    <!-- Botón para cancelar la creación de la marca y redirigir a la página de lista de marcas -->
                    <button type="button" id="btnCancelar" class="btnCancelar ml-2 px-6 py-3 text-base font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">
                        Cancelar
                    </button>
                    <!-- Botón para enviar el formulario y crear la nueva marca -->
                    <button type="submit" class="btnAceptar ml-2 px-6 py-3 text-base font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    {{-- Scripts de dropzone --}}
    <!-- Agregar cualquier script adicional relacionado con esta página aquí -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        document.getElementById('btnCancelar').addEventListener('click', function() {
            // Mostrar el SweetAlert de confirmación
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
                // Redireccionar al usuario a la página "tablaProductos"
                window.location.href = '{{ route('marcas') }}';
            }
            });
        });
    </script>
@endsection

@endsection
