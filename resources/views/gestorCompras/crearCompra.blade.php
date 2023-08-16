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
<style>
    .btn-decrementar, .btn-incrementar {
    background-color: #f5f5f5; /* Color de fondo */
    border: none;
    border-radius: 50%;  /* Para hacerlos circulares */
    width: 30px;
    height: 30px;
    cursor: pointer;
    outline: none; 
    transition: background-color 0.3s; /* Efecto al pasar el cursor */
}

.btn-decrementar:hover, .btn-incrementar:hover {
    background-color: #e0e0e0; /* Cambia el color al pasar el cursor */
}

.stock-input {
    text-align: center;
    width: 40px;
    border-radius: 5px; /* Esto le dará esquinas ligeramente redondeadas, si quieres totalmente cuadrado, establece este valor en 0 */
    border: 1px solid #ccc;
}
.btn-decrementar:active, .btn-incrementar:active {
    transform: scale(0.95); /* Esto hará que el botón parezca que se "presiona" al reducirlo ligeramente en tamaño cuando se hace clic */
}
.btn-decrementar:hover, .btn-incrementar:hover {
    transform: scale(0.95) translateY(2px); 
    transition: transform 150ms;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.stock-input::-webkit-inner-spin-button,
.stock-input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Para Firefox */
.stock-input {
  -moz-appearance: textfield;
}

</style>

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
                            <label for="proveedor_id" class="block text-sm font-medium text-gray-700">Nombre del proveedor:</label>
                            <!-- Selector de categorías usando Select2 -->
                            <select name="proveedor_id" id="proveedor_id" class="select2 focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none @error('proveedor') border-red-500 @enderror" >
                                <option value="">-- Seleccione un proveedor --</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor_id')
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
                        <div class="w-full mr-4">
                            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
                            <input type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ old('referencia') }}">
                            @error('referencia')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex space-x-4 mt-4">
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
                        <div class="w-full mr-4">
                            <label for="precioCompra" class="block text-sm font-medium text-gray-700">Precio de compra</label>
                            <input type="text" id="precioCompra" name="precioCompra" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('precioCompra') border-red-500 @enderror" value="{{ old('precioCompra') }}">
                            @error('precioCompra')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock a anañir:</label>
                            <input type="number" id="stock" name="stock" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('stock') border-red-500 @enderror" value="{{ old('stock') }}">
                        </div>
                    </div>
                    <br>
                    <div class="flex items-center justify-center h-full w-full">
                        <button id="add_stock" type="button" class="buttonAgregar px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25">
                            <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Añadir producto
                        </button>
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
                        <input type="hidden" name="carrito" id="carrito">
                        @error('carrito')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center @error('carrito') border-red-500 @enderror">{{$message}}</p>
                        @enderror

                    </div>
                    <br>
                    <!-- Comienzo de la tarjeta de totales -->
                    <div class="flex mt-8">  <!-- Usamos Flexbox para organizar los elementos horizontalmente -->

                        <!-- Comienzo del textarea para la descripción -->
                        <div class="flex-grow p-4 w-2/5"> <!-- Ocupa 2/5 del espacio disponible -->
                            <div class="form-group">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <textarea class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror" id="descripcion" name="descripcion" rows="4" placeholder="Ingresa la descripción de la compra...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mt-4 text-center">
                                <button id="agregarCarro" type="submit" class="buttonAgregar px-8 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25 mx-auto">
                                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Realizar Compra
                                </button>
                            </div>
                        </div>
                            <input type="hidden" name="subtotal_input" id="subtotal_input" value="0.00">
                            <input type="hidden" name="iva_input" id="iva_input" value="0.00">
                            <input type="hidden" name="total_input" id="total_input" value="0.00">

                        <!-- Comienzo de la tarjeta de totales -->
                        <div class="bg-white p-4 w-1/4 rounded-lg shadow"> <!-- Ocupa 1/4 del espacio disponible -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Subtotal -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Subtotal:</label>
                                    <span name="subtotal" id="subtotal" class="text-lg font-semibold">$0.00</span>
                                </div>

                                <!-- Espacio en blanco para asegurar la disposición -->
                                <div></div>
                                
                                <!-- IVA -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">IVA (16%):</label>
                                    <span id="iva-value" class="text-lg font-semibold">$0.00</span>
                                </div>

                                <!-- Espacio en blanco para asegurar la disposición -->
                                <div></div>

                                <!-- Total -->
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Total:</label>
                                    <span name="total" id="total" class="text-lg font-semibold">$0.00</span>
                                </div>
                            </div>
                        </div>

                    </div>


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
                    <td style="text-align: center;">
                        <button class="btn-decrementar" style="margin-right: 5px; background-color:#82C554!important;"><i class="fas fa-minus text-white"></i></button>
                        <input type="number" style="width: 40px; text-align: center;" value="${producto.stock}" class="stock-input">
                        <button class="btn-incrementar" style="margin-right: 5px; background-color:#82C554!important;"><i class="fas fa-plus text-white"></i></button>
                    </td>
                    <td style="text-align: center;">$${producto.precio_compra}</td>
                    <td style="text-align: center;">$${producto.subtotal}</td>
                    <td style="text-align: center;">$${producto.precio_venta}</td>
                    <td style="text-align: center;">$${producto.total}</td>
                    <td>
                        <button type="button" class="btn-borrar flex items-center justify-center" style="background-color: #FF7F7F; color: white; width: 32px; height: 32px; transition: transform 150ms; transform: translateY(0); border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#myTable tbody').append(newRow);
        });

        updateValues();
        updateHiddenInput();
    }

    $('#producto').change(function() {
        let productoId = $(this).val();
        
        // Buscar el producto en el carrito
        let productoEnCarrito = carrito.find(p => p.product_id == productoId);
        
        if (productoEnCarrito) {
            // Si el producto está en el carrito, establecer el valor del input precioCompra
            // con el precio actual en el carrito
            $("#precioCompra").val(productoEnCarrito.precio_compra);
            return; // Termina la ejecución de la función aquí
        }

        if (!productoId) {
            $('#precioCompra').val('');
            return;
        }

        let urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}".replace('ID_PRODUCTO', productoId);

        $.ajax({
            url: urlProducto,
            type: 'GET',
            dataType: 'json',
            success: function(productDetails) {
                let precio = productDetails.precio_compra;
                $('#precioCompra').val(precio).attr('value', precio);  // Aquí actualizamos tanto el valor como el atributo 'value'
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



    $('#add_stock').click(function(e) {
        e.preventDefault();

        var productoId = $("#producto").val();
        var stockToAdd = parseInt($("#stock").val());
        var precioCompraActual = parseFloat($("#precioCompra").val());
        var proveedorId = $("#proveedor_id").val(); // Obtienes el ID del proveedor seleccionado
        var urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}".replace('ID_PRODUCTO', productoId);

        if (!productoId || isNaN(stockToAdd) || stockToAdd <= 0 || isNaN(precioCompraActual) || precioCompraActual <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar un producto, colocar una cantidad de stock válida y un precio de compra válido.',
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
                    productoExistente.precio_compra = precioCompraActual;
                    productoExistente.proveedor_id = proveedorId; // Añades el ID del proveedor

                    // También necesitas actualizar el subtotal y el total para este producto
                    productoExistente.subtotal = (precioCompraActual * productoExistente.stock) - (precioCompraActual * productoExistente.stock * 0.16);
                    productoExistente.total = precioCompraActual * productoExistente.stock;
                } else {
                    carrito.push({
                        product_id: productDetails.id,
                        nombre: productDetails.nombre,
                        stock: stockToAdd,
                        precio_compra: precioCompraActual,
                        subtotal: (precioCompraActual * stockToAdd) - (precioCompraActual * stockToAdd * 0.16),
                        total: precioCompraActual * stockToAdd,
                        imagen: productDetails.imagen,
                        unidades_disponibles: productDetails.unidades_disponibles,
                        precio_venta: productDetails.precio_venta,
                        proveedor_id: proveedorId  // Aquí también añades el ID del proveedor
                    });
                }

                renderizarCarrito();
                $("#producto").prop('selectedIndex', 0).trigger('change');
                $("#stock").val('');
                $("#precioCompra").val('');
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
    $(document).on('click', '.btn-incrementar', function(e) {
        e.preventDefault();

        let row = $(this).closest('tr');
        let productName = row.find("td").eq(1).text();
        let producto = carrito.find(p => p.nombre === productName);

        producto.stock += 1;
        producto.subtotal = (producto.precio_compra * producto.stock) - (producto.precio_compra * producto.stock * 0.16);
        producto.total = producto.precio_compra * producto.stock;

        renderizarCarrito();
    });

    $(document).on('click', '.btn-decrementar', function(e) {
        e.preventDefault();

        let row = $(this).closest('tr');
        let productName = row.find("td").eq(1).text();
        let producto = carrito.find(p => p.nombre === productName);

        if (producto.stock > 1) { // Aquí garantizas que el stock no sea menor que 1
            producto.stock -= 1;
            producto.subtotal = (producto.precio_compra * producto.stock) - (producto.precio_compra * producto.stock * 0.16);
            producto.total = producto.precio_compra * producto.stock;

            renderizarCarrito();
        }
    });

    $(document).on('input', '.stock-input', function(e) {
        let row = $(this).closest('tr');
        let productName = row.find("td").eq(1).text();
        let producto = carrito.find(p => p.nombre === productName);
        let nuevoStock = parseInt($(this).val());

        // Si el valor del input no es un número (por ejemplo, si está vacío), se establecerá como 0
        if (isNaN(nuevoStock) || nuevoStock <= 0) {
            nuevoStock = 0;
        }

        producto.stock = nuevoStock;
        producto.subtotal = (producto.precio_compra * producto.stock) - (producto.precio_compra * producto.stock * 0.16);
        producto.total = producto.precio_compra * producto.stock;
        renderizarCarrito();

        $(this).val(nuevoStock); // Establece el valor del input, en caso de que haya sido borrado o sea un número inválido
    });


        $(document).on('keydown', '.stock-input', function(e) {
            if (e.keyCode === 13) {  // 13 es el código de la tecla "Enter"
                e.preventDefault();
            }
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
