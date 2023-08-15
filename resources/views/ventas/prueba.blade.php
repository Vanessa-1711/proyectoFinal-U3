@extends('layouts.app')
@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="{{asset('css/estilosVentas.css')}}">

<style>
.categoria-tarjeta.selected {
    border: 2px solid #B38CC4;
    background-color: #B38CC4;
    color: black!important;
}
.categoria-tarjeta.selected h3 {
    color: black;
}
.no-spinners::-webkit-inner-spin-button,
.no-spinners::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.no-spinners {
  -moz-appearance: textfield;
}
</style>
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

@section('titulo')
    Punto de Venta
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
    
@endsection

@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="tarjeta-izquierda flex-none w-full md:w-1/2 px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-4">
          <!-- Contenedor de los botones -->
            <div class="flex justify-start items-center mb-2 mt-2">
                <!-- Flecha izquierda -->
                <div class="swiper-button-prev w-8 h-8 bg-gray-300 hover:bg-gray-400 rounded-full text-white flex items-center justify-center text-lg">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                </div>

                <!-- Flecha derecha -->
                <div class="swiper-button-next w-8 h-8 bg-gray-300 hover:bg-gray-400 rounded-full text-white flex items-center justify-center text-lg">
                <span class="sr-only">Next</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                </svg>
                </div>
            </div>
            <div class="swiper-container swiper relative flex flex-wrap">
                <div class="swiper-wrapper">
                    <br>
                <!-- Tarjetas del slider -->
                @foreach ($categorias as $categoria)
                <div id="categoria-{{ $categoria->id }}" class="swiper-slide categoria-tarjeta w-1/2 md:w-2/5 lg:w-1/4" data-id="{{ $categoria->id }}">
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <img src="{{ asset('uploads/' . $categoria->imagen) }}" 
                            alt="Imagen del producto"  
                            class="text-xs font-semibold leading-tight dark:text-white text-slate-400 mb-2" 
                            style="max-width: 60px; max-height: 120px;">
                        <h3 class="mt-2">{{ $categoria->nombre }}</h3>
                    </div>
                </div>

                @endforeach



              <!-- Agrega más tarjetas de categorías aquí -->
            </div>
          </div>
        </div>
      </div>
      <!-- Sección de tarjetas de productos -->
    <div class="tarjetas-productos flex flex-wrap -mx-3 mt-6">
        <!-- Tarjeta de producto 1 -->
        <div id="productos-section" class="tarjetas-productos flex flex-wrap -mx-3 mt-6">
            <!-- Las tarjetas de productos serán cargadas aquí -->
        </div>


        <!-- Agrega más tarjetas de productos aquí -->
    </div>

    </div>
            <!-- Columna derecha - Imagen del producto y botón para editar -->
            <div class="tarjeta-derecha flex-none w-full md:w-1/2 px-0">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <!-- Muestra el nombre del producto -->
                        <div class="producto-info p-4">
                            <h3 class="text-xl text-center font-bold">Carrito</h3>
                            
                            <!-- Formulario -->
                            <form action="{{ route('ventas.store') }}" method="post" novalidate> <!-- Puedes especificar una URL en 'action' y un método HTTP para cuando se envíe el formulario -->
                                @csrf

                                <div class="mt-4">
                                    <label for="cliente_id" class="block text-sm font-medium text-gray-700">Selecciona un usuario</label>
                                    <select id="cliente_id" name="cliente_id" style="width: 360px;" class="select2 mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('cliente_id') border-red-500 @enderror">
                                        <option value="">-- Seleccione un proveedor --</option>
                                        @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="mt-4">
                                    <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
                                    <input type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ old('referencia') }}">
                                    @error('referencia')
                                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                    @enderror
                                    
                                    
                                </div>
                                <br>
                                <div class="flex flex-col items-center justify-center h-screen">
                                    <h4 class="mb-4">Lista de productos</h4>
                                    <button id="eliminarTodosProductos" type="button" class="buttonAgregar px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25">
                                        <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Eliminar todos los productos
                                    </button>
                                </div>


                                <div id="listaProductosCarrito" class="mt-4">
                                    <!-- Las tarjetas de productos se agregarán aquí -->
                                </div>

                                <!-- Sección de Subtotal, IVA y Total -->
                                <div class="mt-4">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Subtotal:</span>
                                        <span id="subtotal" class="font-medium">$0.00</span> <!-- Aquí debes insertar el valor del subtotal -->
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <span class="font-medium">IVA (16%):</span>
                                        <span id="iva" class="font-medium">$0.00</span> <!-- Aquí debes insertar el valor del IVA, generalmente es un porcentaje del subtotal -->
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <span class="font-bold">Total:</span>
                                        <span id="total" class="font-bold">$0.00</span> <!-- Aquí debes insertar el valor total (subtotal + IVA) -->
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-0 pb-0 pl-4 mb-2 pt-2" >
                                    <label for="cambio" class="mr-2">Pago con:</label>
                                    <input style="outline:none; width: 70px; border:1px solid #b0b1b9; border-radius: 10px; color:black; padding:5px; padding-left: 10px" type="number" id="pagocon" name="pagocon" min="0" step="any" value="{{old('pagocon')}}">
                                    <div id="mensajeCambio" class="mt-2"></div>
                                </div>
                                @error('pagocon')
                                    <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                        {{$message}}
                                    </p>    
                                @enderror
                                <input type="hidden" name="subtotal_input" id="subtotal_input" value="0.00">
                                <input type="hidden" name="iva_input" id="iva_input" value="0.00">
                                <input type="hidden" name="total_input" id="total_input" value="0.00">
                                <input type="hidden" id="cambio" name="cambio" value="0.00">


                                <input type="hidden" id="carrito" name="carrito" class="@error('carrito') border-red-500 @enderror">
                                @error('carrito')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                @enderror

                                <!-- Botón de envío -->
                                <div class="mt-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Confirmar compra</button>
                                </div>
                            </form>

                            <!-- Fin del formulario -->

                        </div>
                        <!-- Fin de los detalles del producto -->
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  // Inicializar el slider cuando el documento esté listo
  document.addEventListener("DOMContentLoaded", function () {
    // Inicializar Swiper
    var mySwiper = new Swiper(".swiper", {
      slidesPerView: "auto",
      spaceBetween: 20,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  });
</script>

<script>


$(document).ready(function(){
    let carrito = [];
    
    // Comprobar si hay datos antiguos en 'carrito'
    @if(old('carrito'))
        carrito = {!! json_encode(json_decode(urldecode(old('carrito')))) !!};
        renderizarCarrito();
    @endif

    // Cargar todos los productos al inicio
    cargarTodosLosProductos();

    function updateValues() {
        let total = 0;
        carrito.forEach(producto => {
            total += producto.precio_compra * producto.stock;
        });

        let iva = total * 0.16;
        let subtotal = total - iva;

        $('#subtotal').text(`$${subtotal.toFixed(2)}`);
        $('#iva').text(`$${iva.toFixed(2)}`);
        $('#total').text(`$${total.toFixed(2)}`);

        $('#subtotal_input').val(subtotal.toFixed(2));
        $('#iva_input').val(iva.toFixed(2));
        $('#total_input').val(total.toFixed(2));
    }

    function renderizarCarrito() {
        $('#listaProductosCarrito').empty();

        carrito.forEach(producto => {
            let tarjetaProducto = `
            <div id="productoCarrito-${producto.id}" class="producto-agregado flex justify-between items-center border p-2 mt-2 rounded">
                <img src="${producto.imagen}" alt="Imagen del producto" style="width: 160px; height: 160px;"  class="w-16 h-16 rounded-lg mr-4">
                <div>
                    <h4 class="font-semibold" style="text-align: center;">${producto.nombre}</h4>
                    <p class="precio-producto">Precio: $${producto.precio_compra.toFixed(2)}</p>
                    <p class="total">Total: $${(producto.precio_compra * producto.stock).toFixed(2)}</p>
                    <div class="flex items-center">
                        <button type="button" class="cantidad-btn bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" style="transition: transform 150ms; transform: translateY(0);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'" data-action="decrementar">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                        <input type="number" class="no-spinners focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none mx-2" value="${producto.stock}" min="1" max="${producto.unidades_disponibles}" style="width: 50px; text-align: center;outline:none;" data-id="${producto.id}" oninput="validarCantidadInput(${producto.id}, this)" />
                        <button type="button" class="cantidad-btn bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" style="transition: transform 150ms; transform: translateY(0);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'" data-action="incrementar">
                            <i class="fas fa-plus text-white"></i>
                        </button>

                    </div>
                </div>
                <button type="button" class="eliminar-btn flex items-center justify-center" style="background-color: #FF7F7F; color: white; width: 32px; height: 32px; transition: transform 150ms; transform: translateY(0); border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-trash-alt"></i>
                </button>



            </div>`;

            
            $('#listaProductosCarrito').append(tarjetaProducto);
        });

        updateValues();
        $('#carrito').val(JSON.stringify(carrito));
    }

    function validarCantidadInput(productId, inputElement) {
    const cantidad = parseInt(inputElement.value);
    const productoTarjeta = $(`#producto-${productId}`);
    const unidadesDisponibles = parseInt(productoTarjeta.find('p').eq(2).text().replace('Unidades disponibles: ', ''));
    
    // Comprobar si la cantidad excede las unidades disponibles y ajustar si es necesario
    if (cantidad > unidadesDisponibles) {
        inputElement.value = unidadesDisponibles;  // Establece el input al máximo de unidades disponibles
        productoTarjeta.find('.mensaje-error').text("No quedan productos disponibles. Se han agregado el máximo de productos disponibles.").show();
    } else {
        productoTarjeta.find('.mensaje-error').hide();
    }

    // Actualizar el carrito
    let producto = carrito.find(p => p.id == productId);
    if (producto) {
        producto.stock = parseInt(inputElement.value);  // Aquí usamos el valor ajustado del input, no la variable "cantidad"
    }

    // Actualizar el total y otros valores en la interfaz
    renderizarCarrito();
}
    function cargarTodosLosProductos() {
        $.ajax({
            url: "{{ route('ventas.getProducto') }}",
            method: 'GET',
            dataType: 'json',
            success: function(productos) {
                renderizarProductos(productos);
            },
            error: function(error) {
                console.error("Error al cargar productos:", error);
            }
        });
    }   
    function cargarProductosPorCategoria(categoriaId) {
        $.ajax({
            url: "{{ route('ventas.productosByCategoria', '') }}/" + categoriaId,
            method: 'GET',
            dataType: 'json',
            success: function(productos) {
                renderizarProductos(productos);
            },
            error: function(error) {
                console.error("Error al cargar productos por categoría:", error);
            }
        });
    }

    function renderizarProductos(productos) {
        let contenido = '';
        if (productos.length === 0) {
            contenido = '<h3>Esta categoría no tiene productos.</h3>';
        } else {
            productos.forEach(producto => {
                let botonAgregar = `<a href="#" class="agregar-btn"><i class="fas fa-shopping-cart mr-2"></i>Agregar producto</a>`;
                
                // Verifica si el stock es 0 o menor
                if (producto.unidades_disponibles <= 0) {
                    botonAgregar = '<h4 style="color: red;">Agotado</h4>';
                }

                contenido += `
                <div id="producto-${producto.id}" class="producto-tarjeta bg-white w-48" style="margin-right: 10px; margin-bottom: 10px;">
                    <div class="product-info relative">
                        <img class="w-1/2 mx-auto my-4" src="{{ asset('uploads') }}/${producto.imagen}" 
                            alt="Imagen del producto"  
                            class="text-xs font-semibold leading-tight dark:text-white text-slate-400 rounded-xl mb-2" 
                            style="max-width: 150px; max-height: 150px;">
                        <h3 class="mt-2">${producto.nombre}</h3>
                        <p>Precio: $${producto.precio_venta}</p>
                        <p>Marca: ${producto.marca.nombre}</p>
                        <p>Unidades disponibles: ${producto.unidades_disponibles}</p>
                        ${botonAgregar}
                        <p class="mensaje-error mt-1" style="color: red; display: none;">No hay unidades disponibles para esa cantidad</p>
                    </div>
                </div>`;
            });
        }
        $('#productos-section').html(contenido);
    }





    $('.categoria-tarjeta').on('click', function(e) {
        e.preventDefault();
        const categoriaId = $(this).data('id');

        if ($(this).hasClass('selected')) {
            cargarTodosLosProductos(); // Si ya está seleccionada, cargamos todos los productos nuevamente
            $(this).removeClass('selected');
        } else {
            cargarProductosPorCategoria(categoriaId);
            $('.categoria-tarjeta').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    var urlProducto = "{{ route('ventas.getProducto')}}";

    $(document).on('click', '.agregar-btn', function(e) {
        e.preventDefault();
        
        const productoTarjeta = $(this).closest('.producto-tarjeta');
        const productId = productoTarjeta.attr('id').split('-')[1];
        const nombreProducto = $(this).siblings('h3').text();
        const precioProducto = parseFloat($(this).siblings('p').eq(0).text().replace('Precio: $', ''));
        const unidadesDisponibles = parseInt($(this).siblings('p').eq(2).text().replace('Unidades disponibles: ', ''));
        
        let productoEnCarrito = carrito.find(p => p.id == productId);
        let cantidadEnCarrito = productoEnCarrito ? productoEnCarrito.stock : 0;
        let cantidadDeseada = 1; // Porque estás añadiendo 1 cada vez que haces clic en el botón

        let cantidadTotal = cantidadEnCarrito + cantidadDeseada;

        if (cantidadTotal > unidadesDisponibles) {
            productoTarjeta.find('.mensaje-error').show();
            return;  // No continuar si no hay unidades disponibles.
        } else {
            productoTarjeta.find('.mensaje-error').hide();
        }

        if (productoEnCarrito) {
            productoEnCarrito.stock = cantidadTotal;
        } else {
            let productoNuevo = {
                id: productId,
                nombre: nombreProducto,
                precio_compra: precioProducto,
                stock: cantidadDeseada,
                imagen: productoTarjeta.find('img').attr('src')
            };
            carrito.push(productoNuevo);
        }

        renderizarCarrito();
    });


    $(document).on('click', '.cantidad-btn', function(e) {
        const accion = $(this).data('action');
        const productoEnCarrito = $(this).closest('.producto-agregado');
        
        const precioTexto = productoEnCarrito.find('.precio-producto').text().trim();
        const precioProducto = parseFloat(precioTexto.replace('Precio: $', '').replace(',', ''));
        
        let inputCantidad = productoEnCarrito.find('input[type="number"]');
        let cantidad = parseInt(inputCantidad.val());
        if(isNaN(cantidad)) {
            cantidad = 1;
        }

        if (accion === "incrementar") {
            cantidad += 1;
        } else if (accion === "decrementar" && cantidad > 1) {
            cantidad -= 1;
        }

        const productId = productoEnCarrito.attr('id').split('-')[1];
        const productoTarjeta = $(`#producto-${productId}`);
        const unidadesDisponibles = parseInt(productoTarjeta.find('p').eq(2).text().replace('Unidades disponibles: ', ''));

        if (cantidad <= unidadesDisponibles && cantidad > 0) {
            productoTarjeta.find('.mensaje-error').hide();
        } else {
            productoTarjeta.find('.mensaje-error').show();
            return; // No continuar si no hay unidades disponibles.
        }
        inputCantidad.val(cantidad);
        // Actualiza la cantidad en el objeto carrito
        let producto = carrito.find(p => p.id == productId);
        if(producto) {
            producto.stock = cantidad; // Actualiza la cantidad en el carrito
        }

        renderizarCarrito(); // Renderizar de nuevo el carrito para reflejar los cambios
    });

    $(document).on('click', '.eliminar-btn', function(e) {
        e.preventDefault();
        
        // Encuentra la tarjeta del producto en el carrito.
        const productoEnCarrito = $(this).closest('.producto-agregado');
        const productId = productoEnCarrito.attr('id').split('-')[1];
        
        // Elimina el producto del carrito.
        carrito = carrito.filter(producto => producto.id != productId);
        
        // Ocultar el mensaje de error en la tarjeta del producto.
        const productoTarjeta = $(`#producto-${productId}`);
        productoTarjeta.find('.mensaje-error').hide();

        // Actualizar la interfaz.
        renderizarCarrito();
    });
    
    $(document).on('change', '.cantidad-input', function(e) {
            const productoEnCarrito = $(this).closest('.producto-agregado');
            let cantidad = parseInt($(this).val());
            const productId = productoEnCarrito.attr('id').split('-')[1];
            const productoTarjeta = $(`#producto-${productId}`);
            const unidadesDisponibles = parseInt(productoTarjeta.find('p').eq(2).text().replace('Unidades disponibles: ', ''));

            if (cantidad <= unidadesDisponibles && cantidad > 0) {
                productoTarjeta.find('.mensaje-error').hide();
            } else {
                productoTarjeta.find('.mensaje-error').show();
                $(this).val(cantidad > 0 ? unidadesDisponibles : 1);
                cantidad = $(this).val();
            }

            let producto = carrito.find(p => p.id == productId);
            if (producto) {
                producto.stock = cantidad;
            }

            let total = cantidad * parseFloat(productoEnCarrito.find('.precio-producto').text().trim().replace('Precio: $', '').replace(',', ''));
            productoEnCarrito.find('.total').text(`Total: $${total.toFixed(2)}`);
            updateValues();
        });
        $(document).on('click', '#eliminarTodosProductos', function(e) {
            e.preventDefault();
            
            // Vacía el array del carrito
            carrito = [];
            
            // Oculta todos los mensajes de error
            $('.mensaje-error').hide();
            
            // Actualiza la interfaz
            renderizarCarrito();
        });



        $(document).on('input', 'input[data-id]', function() {
            const productoId = $(this).data('id');
            validarCantidadInput(productoId, this);
        });

        $(document).ready(function() {
            $('#pagocon').on('input', function() {
                var pagoCon = parseFloat($(this).val());
                var totalCompra = parseFloat($('#total').text().replace('$', '')); // Asumiendo que el total ya tiene el símbolo de '$'

                if (isNaN(pagoCon)) {
                    $('#mensajeCambio').text('Por favor, ingrese una cantidad válida.');
                    $('#cambio').val('0.00'); // Asegúrate de resetear el valor del cambio en el input oculto
                    return;
                }

                if (pagoCon < totalCompra) {
                    $('#mensajeCambio').text('El monto no es suficiente para cubrir el total.');
                    $('#cambio').val('0.00'); // Asegúrate de resetear el valor del cambio en el input oculto
                } else {
                    var cambio = pagoCon - totalCompra;
                    $('#mensajeCambio').text('Cambio: $' + cambio.toFixed(2));
                    $('#cambio').val(cambio.toFixed(2)); // Aquí estamos estableciendo el valor del cambio en el input oculto
                }
            });
        });


    




});



</script>
@endsection