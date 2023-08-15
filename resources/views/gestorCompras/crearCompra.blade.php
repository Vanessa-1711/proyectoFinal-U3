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
                <form id="formularioProductos" action="{{ route('compras.store') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="flex space-x-4">
                        <div class="w-full mr-4">
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Nombre del proveedor:</label>
                            <!-- Selector de categorías usando Select2 -->
                            <select name="proveedor_id" id="proveedor_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('proveedor') border-red-500 @enderror" >
                                <option value="">-- Seleccione un proveedor --</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor') == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full mr-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha de compra:</label>
                            <input type="date" id="fecha" name="fecha" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('fecha') border-red-500 @enderror" value="{{ old('fecha') }}">
                            @error('fecha')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
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
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
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
                        </div>
                        <div class="w-full">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock a anañir:</label>
                            <input type="number" id="stock" name="stock" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('stock') border-red-500 @enderror" value="{{ old('stock') }}">
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
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Subtotal</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Costo Unitario</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Costo Total</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                            
                                </tbody>
                                    
                            </table>
                        </div>
                    </div>
                    <br>
                    <!-- Comienzo de la tarjeta de totales -->
                    <div class="flex mt-8">  <!-- Usamos Flexbox para organizar los elementos horizontalmente -->

                        <!-- Comienzo del textarea para la descripción -->
                        <div class="flex-grow p-4 w-2/5"> <!-- Ocupa 2/5 del espacio disponible -->
                            <div class="form-group">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <textarea class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror" id="descripcion" name="descripcion" rows="4" placeholder="Ingresa la descripción de la compra..."></textarea>
                                @error('descripcion')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mt-4 text-center">
                                <button id="agregarCarro" type="submit" class="buttonAgregar px-8 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25 mx-auto">
                                    <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Realizar Compra
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="subtotal_input" id="subtotal_input" value="0.00">
                            <input type="hidden" name="iva_input" id="iva_input" value="0.00">
                            <input type="hidden" name="total_input" id="total_input" value="0.00">


                        <!-- Comienzo de la tarjeta de totales -->
                        <div class="bg-white p-4 w-1/4 rounded-lg shadow">  <!-- Ocupa 1/4 del espacio disponible -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Subtotal -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Subtotal:</label>
                                    <span name="subtotal" id="subtotal" class="text-lg font-semibold">$0.00</span>
                                </div>

                                <!-- IVA -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">IVA (16%):</label>
                                    <span id="iva-value" class="text-lg font-semibold">$0.00</span>
                                </div>

                                <!-- Total -->
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Total:</label>
                                    <span name="total" id="total" class="text-lg font-semibold">$0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="carrito" id="carrito">

                    <!-- Fin de la tarjeta de totales -->





                    
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- Script para inicializar Select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script>
$(document).ready(function() {
    let carrito = [];
    
    // Comprobar si hay datos antiguos en 'carrito'
    @if(old('carrito'))
        carrito = {!! json_encode(json_decode(urldecode(old('carrito')))) !!};
        renderizarCarrito();
    @endif

    function updateValues() {
        let total = 0;
        carrito.forEach(producto => {
            total += producto.precio_compra * producto.stock;
        });
        
        let iva = total * 0.16; 
        let subtotal = total - iva;

        $('#subtotal').text(`$${subtotal.toFixed(2)}`);
        $('#iva-value').text(`$${iva.toFixed(2)}`);
        $('#total').text(`$${total.toFixed(2)}`);

        $('#subtotal_input').val(subtotal.toFixed(2));
        $('#iva_input').val(iva.toFixed(2));
        $('#total_input').val(total.toFixed(2));
    }

    function updateHiddenInput() {
        $('#carrito').val(JSON.stringify(carrito));
    }

    function renderizarCarrito() {
        $('#myTable tbody').empty();

        carrito.forEach(producto => {
            let newRow = `
                <tr>
                    <td style="text-align: center;"><img src="{{ asset('uploads') }}/${producto.imagen}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"></td>
                    <td style="text-align: center;">${producto.nombre}</td>
                    <td style="text-align: center;">${producto.unidades_disponibles}</td>
                    <td style="text-align: center;">${producto.stock}</td>
                    <td style="text-align: center;">${producto.precio_compra}</td>
                    <td style="text-align: center;">${producto.subtotal}</td>
                    <td style="text-align: center;">${producto.precio_venta}</td>
                    <td style="text-align: center;">${producto.total}</td>
                    <td><button class="btn-borrar">Eliminar</button></td>
                </tr>
            `;
            $('#myTable tbody').append(newRow);
        });

        updateValues();
        updateHiddenInput();
    }

    $('#add_stock').click(function(e) {
        e.preventDefault();

        var productoId = $("#producto").val();
        var stockToAdd = parseInt($("#stock").val());
        var urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}".replace('ID_PRODUCTO', productoId);

        if (!productoId || isNaN(stockToAdd) || stockToAdd <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar un producto y colocar una cantidad de stock válida.',
            });
            return; 
        }

        $.ajax({
            url: urlProducto,
            type: 'GET',
            dataType: 'json',
            success: function(productDetails) {
                let productoExistente = carrito.find(p => p.nombre === productDetails.nombre);

                if (productoExistente) {
                    productoExistente.stock += stockToAdd;
                } else {
                    carrito.push({
                        product_id: productDetails.id,
                        nombre: productDetails.nombre,
                        stock: stockToAdd,
                        precio_compra: productDetails.precio_compra,
                        subtotal: (productDetails.precio_compra * stockToAdd) - (productDetails.precio_compra * stockToAdd * 0.16),
                        total: productDetails.precio_compra * stockToAdd,
                        imagen: productDetails.imagen,
                        unidades_disponibles: productDetails.unidades_disponibles,
                        precio_venta: productDetails.precio_venta
                    });
                }

                renderizarCarrito();
                $("#producto").prop('selectedIndex', 0).trigger('change');
                $("#stock").val('');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al obtener detalles del producto.'
                });
            }
        });
    });

    $(document).on('click', '.btn-borrar', function(e) {
        e.preventDefault();

        let productName = $(this).closest('tr').find("td").eq(1).text();
        carrito = carrito.filter(producto => producto.nombre !== productName);
        
        renderizarCarrito();
    });
});
</script>





@endsection
