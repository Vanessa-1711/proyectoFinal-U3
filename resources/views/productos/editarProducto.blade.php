@extends('layouts.app')

@section('titulo')
    Editar Producto
@endsection

@section('estilos2')
<!-- Agregar librerías y estilos requeridos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('estilos')
<!-- Agregar librerías y estilos requeridos para Select2 y Dropzone -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<style>
    .dz-image img{
        height: 120px!important;
        width:120px !important;
    }
</style>
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
          <h6 class="dark:text-white">Editar Producto</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
                <!-- Formulario para subir imágenes utilizando Dropzone -->
                <form action="{{route('imagenesProduc.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone " style="width: 50%!important; border:none;padding:0px; align-items:center!important">
                    @csrf
                </form>
                <!-- Formulario principal para editar el producto -->
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    @if(session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{session('mensaje')}}
                        </p>
                    @endif
                    <div class="mb-5">
                        <input type="hidden" name="imagen"  value="{{ $product->imagen }} ">
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nombre') border-red-500 @enderror" value="{{ old('nombre', $product->nombre) }}" required>
                        @error('nombre')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                        <select name="categoria_id" id="categoria_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('categoria_id') border-red-500 @enderror" required>
                            <option value="">-- Seleccione una categoría --</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $categoria->id == old('categoria_id', $product->categoria_id) ? 'selected' : '' }}>
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
                                <option  value="{{ $subcategoria->id }}" {{ $subcategoria->id == old('subcategoria_id', $product->subcategoria_id) ? 'selected' : '' }}>
                                    {{ $subcategoria->nombre }}
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
                                <option value="{{ $marca->id }}" {{ $marca->id == old('marca_id', $product->marca_id) ? 'selected' : '' }}>
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
                        <input type="text" name="precio_compra" id="precio_compra" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('precio_compra') border-red-500 @enderror" value="{{ old('precio_compra', $product->precio_compra) }}" required>
                        @error('precio_compra')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de venta:</label>
                        <input type="text" name="precio_venta" id="precio_venta" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('precio_venta') border-red-500 @enderror" value="{{ old('precio_venta', $product->precio_venta) }}" required>
                        @error('precio_venta')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="unidades_disponibles" class="block text-sm font-medium text-gray-700">Unidades disponibles:</label>
                        <input type="text" name="unidades_disponibles" id="unidades_disponibles" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('unidades_disponibles') border-red-500 @enderror" value="{{ old('unidades_disponibles', $product->unidades_disponibles) }}" required>
                        @error('unidades_disponibles')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
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

<!-- Inicializar Select2 -->
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
@endsection
