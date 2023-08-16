@extends('layouts.app')

@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('estilos2')
<!-- Agregar librerías y estilos requeridos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield; /* Firefox */
}
</style>
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
            <form action="{{route('devoluciones.store')}}" method="post" novalidate>
              @csrf
              <div class="mb-4 flex justify-center"> <!-- Clases añadidas para centrar el contenido -->
                  <label for="state" class="block text-sm font-medium text-gray-700">Referencias de ventas:</label>
                  <br>
                  <select name="referencia" id="referencia" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-black/80 text-sm leading-5.6 ease w-1/2 mx-auto appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none" value="{{old('referencia')}}"> <!-- Clases w-1/2 y mx-auto añadidas -->
                      <option value="">Seleccione una referencia</option>
                      @foreach($ventas as $venta)
                          <option value="{{ $venta->id }}">{{ $venta->referencia }}</option>
                      @endforeach
                  </select>
                  @error('referencia')
                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>    
                @enderror
              </div>

              <div id="productosContainer" class="flex flex-wrap justify-center">

              </div>
              

              <div class="text-left">
                  <button type="button" class="btnCancelar btn-secondary my-4 p-2 text-black hover:text-white mr-2">
                      <a href="{{route('devoluciones')}}">Cancelar</a>
                  </button>
                  <button type="submit" class="btnAceptar  btn-primary my-4 p-2 text-white hover:text-white ml-2">
                      Guardar
                  </button>
              </div>




            </form>
            <a href="{{ route('devoluciones.productosByReferencia', $venta) }}">Ver productos</a>
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
        window.location.href = '{{ route('devoluciones.create') }}';
      }
    });
  });
</script>


<script>
$(document).ready(function() {
    $('#referencia').on('change', function() {
        let ventaId = $(this).val();

        if (ventaId) {
            $.ajax({
                url: '/devoluciones/' + ventaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let productosCards = '';

                    data.productos.forEach(function(item) {
                        let producto = item.producto;
                        let cantidadComprada = item.cantidad || 0;
                        let precioUnitario = parseFloat(producto.precio_venta) || 0;
                        let total = cantidadComprada * precioUnitario;

                        productosCards += `
                            <div id="productoCarrito-${producto.id}" class="producto-agregado flex justify-between items-center border p-2 mt-2 rounded">
                            <input type="hidden" name="productos[${producto.id}]" value="${producto.id}">
                                <img src="{{ asset('uploads/') }}/${producto.imagen}" alt="Imagen del producto" style="width: 160px; height: 160px;" class="w-8 h-8 rounded-lg mr-2">
                                <div>
                                    <h4 class="font-semibold" style="text-align: center;">${producto.nombre}</h4>
                                    <p class="precio-producto">Precio unitario: $${precioUnitario.toFixed(2)}</p>
                                    <p>Cantidad comprada: ${cantidadComprada}</p>
                                    <p class="total">Total: $${total.toFixed(2)}</p>
                                    <div class="flex items-center">
                                        <button type="button" class="cantidad-btn bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" style="background-color:#82C554!important; transition: transform 150ms; transform: translateY(0);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'" data-action="decrementar">
                                            <i class="fas fa-minus text-white"></i>
                                        </button>
                                        <input name="cantidades_devueltas[${producto.id}]" type="number" class="no-spinners cantidad-input focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none mx-2" value="0" min="0" max="${cantidadComprada}" style="width: 50px; text-align: center;outline:none;" data-id="${producto.id}" oninput="validarCantidadInput(${producto.id}, this)" />
                                        <button type="button" class="cantidad-btn bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" style="background-color:#82C554!important; transition: transform 150ms; transform: translateY(0);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'" data-action="incrementar">
                                            <i class="fas fa-plus text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;
                    });

                    $('#productosContainer').html(productosCards);
                }
            });
        } else {
            $('#productosContainer').empty();
        }
    });

    // Evento para aumentar o disminuir cantidad en el input
    $(document).on('click', '.cantidad-btn', function() {
        let inputElement = $(this).siblings('input');
        let maxCantidad = parseFloat(inputElement.attr('max'));
        let currentCantidad = parseFloat(inputElement.val());

        if ($(this).data('action') === 'incrementar') {
            if (currentCantidad < maxCantidad) {
                inputElement.val(currentCantidad + 1);
            } else {
                Swal.fire('Cantidad máxima alcanzada', 'No puedes agregar más productos de los que compraste.', 'warning');
            }
        } else if ($(this).data('action') === 'decrementar') {
            if (currentCantidad > 0) {
                inputElement.val(currentCantidad - 1);
            }
        }

        // Verificar si la cantidad ingresada excede el límite y corregirlo
        if (currentCantidad > maxCantidad) {
            inputElement.val(maxCantidad);
            Swal.fire('Cantidad máxima alcanzada', 'No puedes agregar más productos de los que compraste.', 'warning');
        }
    });
    $(document).on('input', '.cantidad-input', function() {
        let inputElement = $(this);
        let maxCantidad = parseFloat(inputElement.attr('max'));
        let currentCantidad = parseFloat(inputElement.val());

        if (currentCantidad > maxCantidad) {
            inputElement.val(maxCantidad);
            Swal.fire('Cantidad máxima alcanzada', 'No puedes agregar más productos de los que compraste.', 'warning');
        } else if (currentCantidad < 0) {
            inputElement.val(0);
            Swal.fire('Cantidad mínima alcanzada', 'No puedes ingresar una cantidad negativa.', 'warning');
        }
    });
});






</script>

@endsection
