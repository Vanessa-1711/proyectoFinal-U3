@extends('layouts.app')

@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection

@section('titulo')
    Devolución de Venta
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de devolución de venta -->
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Registrar Devolución</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-6">
            <form action="{{route('devoluciones.imagen.store')}}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone " style="width: 100%; border:none;padding:0px; align-items:center">
                @csrf
            </form>

            <form action="{{ route('devoluciones.store') }}" method="POST" novalidate>
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif

                <!-- Campos para devolución de venta -->
                <div class="mb-4">
                    <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre de Producto:</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" class="form-input">
                </div>
                <div class="mb-4">
                    <label for="fecha_devolucion" class="block text-sm font-medium text-gray-700">Fecha de Devolución:</label>
                    <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-input">
                </div>
                <div class="mb-4">
                    <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente:</label>
                    <input type="text" name="cliente" id="cliente" class="form-input">
                </div>
                <div class="mb-4">
                    <label for="estatus" class="block text-sm font-medium text-gray-700">Estatus:</label>
                    <select name="estatus" id="estatus" class="form-select">
                        <option value="pendiente">Pendiente</option>
                        <option value="completado">Completado</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="total_pagado" class="block text-sm font-medium text-gray-700">Total pagado:</label>
                    <input type="number" name="total_pagado" id="total_pagado" class="form-input">
                </div>

                <div class="mb-4">
                    <label for="adeudo" class="block text-sm font-medium text-gray-700">Adeudo:</label>
                    <input type="number" name="adeudo" id="adeudo" class="form-input">
                </div>
                <div class="mb-4">
                    <label for="estatus_pago" class="block text-sm font-medium text-gray-700">Estatus del Pago:</label>
                    <select name="estatus_pago" id="estatus_pago" class="form-select">
                        <option value="pendiente">Pendiente</option>
                        <option value="pagado">Pagado</option>
                    </select>
                </div>
                
                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{old('imagen')}}">
                </div>

                <div class="flex justify-center">
                    <button type="button" id="btnCancelar" class="btnCancelar mr-2">Cancelar</button>
                    <button type="submit" class="btnAceptar ml-2">Registrar</button>
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
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script>
  document.getElementById('btnCancelar').addEventListener('click', function() {
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
        window.location.href = '{{ route('tablaDevoluciones') }}';
      }
    });
  });
</script>
@endsection
