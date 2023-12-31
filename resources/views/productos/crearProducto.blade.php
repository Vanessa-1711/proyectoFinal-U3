@extends('layouts.app')

@section('estilos2')
<!-- Agregar librerías y estilos requeridos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('estilos')
<!-- Agregar librerías y estilos requeridos para Select2 y Dropzone -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection

@section('titulo')
    Agregar Producto
@endsection

@section('contenido_top')
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
          <h6 class="dark:text-white">Registrar Producto</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <!-- Formulario para subir imágenes utilizando Dropzone -->
            <form action="{{route('imagenesProduc.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone " style="width: 100%; border:none;padding:0px; align-items:center">
                @csrf
            </form>

            <!-- Formulario principal para registrar el producto -->
            <form action="{{ route('products.store') }}" method="POST" novalidate>
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
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                    <select name="categoria_id" id="categoria_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('categoria_id') border-red-500 @enderror" required>
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
                
                <!-- Campo para seleccionar la subcategoría -->
                <div class="mb-6">
                    <label for="subcategoria_id" class="block text-sm font-medium text-gray-700">Subcategoría:</label>
                    <select name="subcategoria_id" id="subcategoria_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('subcategoria_id') border-red-500 @enderror" required>
                        <option value="">-- Seleccione una subcategoría --</option>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" {{ old('subcategoria_id') == $subcategoria->id ? 'selected' : '' }}>
                                {{ $subcategoria->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategoria_id')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror  
                </div>
                <div class="mb-4">
                    <label for="marca_id" class="block text-sm font-medium text-gray-700">Marca:</label>
                    <select name="marca_id" id="marca_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('marca_id') border-red-500 @enderror" required>
                        <option value="">-- Seleccione una marca --</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('marca_id')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de compra:</label>
                    <input type="text" name="precio_compra" id="precio_compra" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('precio_compra') border-red-500 @enderror" value="{{old('precio_compra')}}" required>
                    @error('precio_compra')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de venta:</label>
                    <input type="text" name="precio_venta" id="precio_venta" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('precio_venta') border-red-500 @enderror" value="{{old('precio_venta')}}" required>
                    @error('precio_venta')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="unidades_disponibles" class="block text-sm font-medium text-gray-700">Unidades disponibles:</label>
                    <input type="number" name="unidades_disponibles" id="unidades_disponibles" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('unidades_disponibles') border-red-500 @enderror" value="{{old('unidades_disponibles')}}" required>
                    @error('unidades_disponibles')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <!-- Campo oculto para guardar el valor de la imagen -->
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

<!-- Agregar script para inicializar Select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<!-- Agregar script para cancelar el registro y mostrar SweetAlert de confirmación -->
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

<script>
    $(document).ready(function() {
    $('.select2').select2();

    $('#categoria_id').change(function() {
        var categoria_id = $(this).val();

        // Limpia las opciones actuales del select de subcategorías
        $('#subcategoria_id').empty();
        $('#subcategoria_id').append('<option value="">-- Seleccione una subcategoría --</option>');

        // Si hay una categoría seleccionada, realiza la petición AJAX
        if (categoria_id) {
            $.ajax({
                url: '/products/subcategorias/' + categoria_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#subcategoria_id').append('<option value="' + value.id + '">' + value.descripcion + '</option>');
                    });
                }
            });
        }
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var imageId = document.querySelector('input[name="imagen"]').value;

    if (imageId) {
        // Obtener la URL de la imagen usando AJAX y el imageId
        fetch('/imagenProductos/' + imageId)
        .then(response => response.json())
        .then(data => {
            var imageUrl = data.imageUrl;

            // Agrega la imagen a Dropzone
            var mockFile = { name: "Imagen", size: 12345 };
            myDropzone.displayExistingFile(mockFile, imageUrl);
        });
    }
});

</script>
@endsection
