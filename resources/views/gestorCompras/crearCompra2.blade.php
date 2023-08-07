@extends('layouts.app')

@section('titulo')
Añadir Compra
@endsection

@section('estilos2')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Se incluyen las librerías y estilos para Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('contenido_top')
<!-- Fondo para la sección superior -->
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
          <h6 class="dark:text-white">Añadir Compra</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-6">
                <form action="{{ route('compras.create') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="flex space-x-4">
                        <div class="w-full mr-4">
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Nombre del proveedor:</label>
                            <!-- Selector de categorías usando Select2 -->
                            <select name="proveedor" id="proveedor" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('proveedor') border-red-500 @enderror" >
                                <option value="">-- Seleccione un proveedor --</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor') == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor')
                                <p class="text-red-500 my-2 text-sm text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full mr-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha de compra:</label>
                            <input type="date" id="fecha" name="fecha" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('fecha') border-red-500 @enderror" value="{{ old('fecha') }}">
                            @error('fecha')
                                <p class="text-red-500 my-2 text-sm text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 flex items-center justify-center">
                            <div class="mb-4 inline-block">
                                <button id="add_stock" type="button" class="buttonAgregar px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25">
                                    <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Añadir producto
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4 mt-4">
                        <div class="w-full mr-4">
                            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
                            <input type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ old('referencia') }}">
                            @error('referencia')
                                <p class="text-red-500 my-2 text-sm text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full mr-4">
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Producto:</label>
                            <!-- Selector de categorías usando Select2 -->
                            <select name="producto" id="producto" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('producto') border-red-500 @enderror" >
                                <option value="">-- Seleccione un producto --</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ old('producto') == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('producto')
                                <p class="text-red-500 my-2 text-sm text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock a anañir:</label>
                            <input type="number" id="stock" name="stock" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('stock') border-red-500 @enderror" value="{{ old('stock') }}">
                            @error('stock')
                                <p class="text-red-500 my-2 text-sm text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <hr class="linea w-full border-t border-gray-300 mt-2">
                    <br>
                    <div class="mx-4">
                                <!-- Mostrar el mensaje de error (si existe) después de realizar una acción -->
                                @if(session('mensaje'))
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" style="background-color: rgb(196 181 253);">
                                        {{session('mensaje')}}
                                    </p>
                                @endif
                                <div class="flex justify-center">
                                    <table id="myTable" class="items-center table-auto mb-0 align-top border-collapse dark:border-white/40 text-slate-500 w-full max-w-4xl mx-auto">
                                        <thead class="align-bottom">
                                            <tr>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Imagen del producto</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Nombre del producto</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Stock</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Stock añadido</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Precio de compra</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Ipuesto</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Costo Unitario</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Costo Total</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    
                                    </table>
                                </div>
                    
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script para inicializar Select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var productoSeleccionado = null;
    //Funcion para que cada vez que se seleccione un producto se consulte la informacion en el controlador
    $('#producto').change(function() {
        var productoId = $(this).val();
        var urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}"
            .replace('ID_PRODUCTO', productoId);
        if (productoId) {
            $.ajax({
                url: urlProducto,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    productoSeleccionado = data;
                },
                error: function(error) {
                    swal("Error!","Hubo un error al obtener los detalles del producto.","error");
                }
            });
        }
    });
    // Función para agregar el producto seleccionado a la tabla cuando se presione el botón de "Añadir producto"
    $("#add_stock").click(function() {
                var stock = $("input[name='stock']").val();

                if (productoSeleccionado && stock && stock > 0) {
                    var productoExistente = $(`#producto_${productoSeleccionado.id}`);

                    if (productoExistente.length) {
                        // Si el producto ya está en la tabla, suma el stock al stock añadido
                        var stockAnadidoActual = parseInt(productoExistente.find(".stock-nuevo").text());
                        var nuevoStockAnadido = stockAnadidoActual + parseInt(stock);

                        productoExistente.find(".stock-nuevo").text(nuevoStockAnadido);
                        // Calcula el nuevo costo total
                        var nuevoCostoTotal = nuevoStockAnadido * productoSeleccionado.precio_compra;

                        // Actualiza la celda del "costo total"
                        productoExistente.find(".costo-total").text(nuevoCostoTotal);
                        actualizarSumaTotalCosto();
                        // Actualiza el input oculto del stock
                        $(`input[name='stocks_${productoSeleccionado.id}']`).val(nuevoStockAnadido);
                    } else {
                        // Añadir fila a la tabla si el producto no existe en ella
                        var fila = `
                    <tr id="producto_${productoSeleccionado.id}">
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent.">
                            <div class="flex px-2 py-1">
                                <div>
                                    <img src="{{ asset('imagenProductos') }}/${productoSeleccionado.imagen}"  class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="${productoSeleccionado.nombre}" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">${productoSeleccionado.nombre}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent stock-nuevo">${stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.precio_compra}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${Math.round((productoSeleccionado.precio_compra*stock)*0.15)}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.precio_venta}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent costo-total">${productoSeleccionado.precio_compra*stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"">
                            <button type="button" class="btn-borrar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
                        $('#tablaProductos tbody').append(fila);
                        actualizarSumaTotalCosto();

                        // Generar inputs ocultos
                        var inputProducto =
                            `<input type="hidden" name="producto_ids[]" value="${productoSeleccionado.id}">`;
                        var inputStock = `<input type="hidden" name="stocks[]" value="${stock}">`;

                        $("form").append(inputProducto);
                        $("form").append(inputStock);
                    }

                    // Limpiar selección e input
                    $("#productos").val('');
                    $("input[name='stock']").val('');
                    productoSeleccionado = null;
                } else {
                    swal("Error!", "Por favor, selecciona un producto y añade un stock válido", "error");
                }
            });
            // Función para actualizar la suma total del costo
            function actualizarSumaTotalCosto() {
                var sumaTotal = 0;

                // Recorre todas las celdas de "costo total" y suma sus valores
                $(".costo-total").each(function() {
                    sumaTotal += parseFloat($(this).text());
                });

                // Actualiza la etiqueta <p> y el input con el valor calculado
                $("#sumaCostoTotal").text("$" + sumaTotal);
                $("#inputCostoTotal").val(sumaTotal);
            }
            // Función para eliminar un producto de la tabla y sus inputs correspondientes
            $(document).on('click', '.btn-borrar', function(e) {
                e.preventDefault();

                // Obtiene el ID del producto desde el atributo de la fila
                var productoId = $(this).closest('tr').attr('id').replace('producto_', '');

                // Elimina la fila de la tabla
                $(this).closest('tr').remove();

                // Elimina los inputs ocultos relacionados con este producto
                $(`input[name='producto_ids[]'][value='${productoId}']`).remove();
                $(`input[name='stocks_${productoId}']`).remove();

                // Actualiza la suma total del costo después de borrar el producto
                actualizarSumaTotalCosto();
            });
        });
});
</script>

@endsection

