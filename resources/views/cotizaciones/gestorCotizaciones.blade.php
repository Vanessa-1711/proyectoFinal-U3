@extends('layouts.app')

@section('titulo')
Cotizaciones
@endsection

@section('estilos2')
<!-- Estilos y scripts adicionales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('contenido_top')
<div class="absolute bg-y-50 w-full top-0 min-h-75">
    <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
</div>
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Crear Cotización</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6">
                        <form action="{{ route('cotizaciones.store') }}" method="POST" novalidate>
                            @csrf
                            
                            <div class="flex space-x-4">

                                <div class="w-full mr-4">
                                    <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente:</label>
                                    <select name="cliente" id="cliente" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('producto') border-red-500 @enderror">
                                        <option value="">-- Seleccione un cliente --</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('cliente')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- <div class="w-full mr-4">
                                    <label for="cliente" class="block text-sm font-medium text-gray-700">Nombre del Cliente:</label>
                                    <input type="text" id="cliente" name="cliente" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('cliente') border-red-500 @enderror" value="{{ old('cliente') }}">
                                    @error('cliente')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div> --}}
                                <div class="w-full mr-4">
                                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha de Cotización:</label>
                                    <input type="date" id="fecha" name="fecha" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('fecha') border-red-500 @enderror" value="{{ old('fecha') }}">
                                    @error('fecha')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia:</label>
                                    <input type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ old('referencia') }}">
                                    @error('referencia')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex space-x-4 mt-4">
                                <div class="w-full mr-4">
                                    <label for="producto" class="block text-sm font-medium text-gray-700">Producto:</label>
                                    <select name="producto_id" id="producto" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('producto') border-red-500 @enderror">
                                        <option value="">-- Seleccione un producto --</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}" {{ old('producto') == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('producto')
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
                            <div class="mt-4">
                                <h6 class="dark:text-white">Productos Añadidos</h6>
                                <table class="items-center table-auto mb-0 align-top border-collapse dark:border-white/40 text-slate-500 w-full max-w-4xl mx-auto">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Nombre del Producto</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Precio</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Cantidad</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productosAgregados">
                                        <!-- Aquí se agregarán las filas de productos seleccionados -->
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <div class="flex space-x-4 mt-4">
                                <div class="w-full mr-4">
                                    <label for="estatus" class="block text-sm font-medium text-gray-700">Estatus:</label>
                                    <select name="estatus" id="estatus" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('estatus') border-red-500 @enderror">
                                        <option value="">-- Seleccione un estatus --</option>
                                        <option value="enviada" {{ old('estatus') == 'enviada' ? 'selected' : '' }}>Enviada</option>
                                        <option value="pendiente" {{ old('estatus') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    </select>
                                    @error('estatus')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="total" class="block text-sm font-medium text-gray-700">Total:</label>
                                    <input type="number" step="0.01" id="total" name="total" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('total') border-red-500 @enderror" value="{{ old('total') }}">
                                    @error('total')
                                        <p class="text-red-500 my-2 text-sm text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <textarea id="descripcion" name="descripcion" rows="4" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="text-red-500 my-2 text-sm text-center">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            


                            <div class="mt-6">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                                    Guardar Cotización
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

@section('scripts2')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    $('#add_stock').click(function(e) {
        e.preventDefault();

        var proveedor = $("#proveedor option:selected").text();
        var fecha = $("#fecha").val();
        var referencia = $("#referencia").val();
        var productoId = $("#producto").val();  // Asumiendo que este es el ID del producto seleccionado
        var stockToAdd = parseInt($("#stock").val());
        var urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}"
            .replace('ID_PRODUCTO', productoId);

        // Primero, obtén los detalles del producto
        $.ajax({
            url: urlProducto,
            type: 'GET',
            dataType: 'json',
            data: {
                id: productoId
            },
            success: function(productDetails) {
                // Buscar si ya existe una fila en la tabla con ese producto
                var existingRow = null;
                $('#myTable tbody tr').each(function() {
                    var productIdCell = $(this).find("td").eq(1);  // Asume que el nombre del producto es la segunda columna
                    if (productIdCell.text() == productDetails.nombre) {
                        existingRow = $(this);
                        return false;  // Detiene el loop .each
                    }
                });

                if (existingRow) {
                    // Si el producto ya existe en la tabla, actualizar la cantidad de stock
                    var currentStockCell = existingRow.find("td").eq(3);  // Asume que la cantidad de stock es la cuarta columna
                    var currentStock = parseInt(currentStockCell.text());
                    currentStockCell.text(currentStock + stockToAdd);
                } else {
                    // Si el producto no está en la tabla, agregar una nueva fila
                    var newRow = `
                        <tr>
                            <td class="class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" style="text-align: center;"><img src="{{ asset('imagenProductos') }}/${productDetails.imagen}"  class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"></td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.nombre}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.unidades_disponibles}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${stockToAdd}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.precio_compra}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.impuesto}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.precio_venta}</td>
                            <td class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"style="text-align: center;">${productDetails.costo_total}</td>
                            <td></td>
                        </tr>
                    `;
                    $('#myTable tbody').append(newRow);
                    $("#producto").val('');   // Limpia el campo de producto
                    $("#stock").val('');      // Limpia el campo de stock
                }
                
                // Si necesitas hacer otra llamada AJAX para añadirlo al servidor, aquí puedes agregar ese código.

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al obtener detalles del producto.');
            }
        });
    });
</script>
@endsection
