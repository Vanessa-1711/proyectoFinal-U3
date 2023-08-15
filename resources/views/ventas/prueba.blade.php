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
                <div id="categoria-{{ $categoria->id }}" class="swiper-slide categoria-tarjeta w-1/2 md:w-2/5 lg:w-1/4 cursor-pointer" data-id="{{ $categoria->id }}">
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <img src="{{ asset('uploads/' . $categoria->imagen) }}" 
                            alt="Imagen del producto"  
                            class="text-xs font-semibold leading-tight dark:text-white text-slate-400 rounded-xl mb-2" 
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
                            <form action="#" method="post"> <!-- Puedes especificar una URL en 'action' y un método HTTP para cuando se envíe el formulario -->
                                <div class="mt-4">
                                    <label for="usuarioSelect" class="block text-sm font-medium text-gray-700">Selecciona un usuario</label>
                                    <select id="usuarioSelect" name="usuario" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <!-- Opciones del select -->
                                        <!-- Suponiendo que en tu controlador pasaste un array de usuarios a la vista, puedes llenar el select así: -->
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sección de productos en el carrito -->
                                <div id="listaProductosCarrito" class="mt-4">
                                    <!-- Las tarjetas de productos se agregarán aquí -->
                                </div>

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

// Cargar todos los productos al inicio
cargarTodosLosProductos();

$('.categoria-tarjeta').on('click', function(e) {
    e.preventDefault();
    const categoriaId = $(this).data('id');
    cargarProductosPorCategoria(categoriaId);
    $('.categoria-tarjeta').removeClass('selected');
    $(this).addClass('selected');
});

var urlProducto = "{{ route('ventas.getProducto')}}";

$(document).on('click', '.agregar-btn', function(e) {
    e.preventDefault();
    
    const productoTarjeta = $(this).closest('.producto-tarjeta');
    const productId = productoTarjeta.attr('id').split('-')[1];
    const nombreProducto = $(this).siblings('h3').text();
    const precioProducto = parseFloat($(this).siblings('p').eq(0).text().replace('Precio: $', ''));
    
    let productoEnCarrito = $(`#productoCarrito-${productId}`);

    if (productoEnCarrito.length) {
        let cantidad = parseInt(productoEnCarrito.find('.cantidad').text()) + 1;
        let total = cantidad * precioProducto;
        
        productoEnCarrito.find('.cantidad').text(cantidad);
        productoEnCarrito.find('.total').text(`Total: $${total.toFixed(2)}`);
    } else {
        let tarjetaProducto = `
        <div id="productoCarrito-${productId}" class="producto-agregado flex justify-between items-center border p-2 mt-2">
            <img src="${productoTarjeta.find('img').attr('src')}" alt="Imagen del producto" class="w-16 h-16 rounded-lg mr-4">
            <div>
                <h4 class="font-semibold">${nombreProducto}</h4>
                <p class="precio-producto ml-2">Precio: $${precioProducto.toFixed(2)}</p>
                <div class="flex items-center">
                    <button type="button" class="cantidad-btn" data-action="decrementar"><i class="fas fa-minus"></i></button>
                    <span class="cantidad mx-2">1</span>
                    <button type="button" class="cantidad-btn" data-action="incrementar"><i class="fas fa-plus"></i></button>
                </div>
                <p class="total">Total: $${precioProducto.toFixed(2)}</p>
            </div>
            <button type="button" class="eliminar-btn"><i class="fas fa-trash-alt"></i></button>

        </div>`;
        
        $('#listaProductosCarrito').append(tarjetaProducto);
    }
});

$(document).on('click', '.cantidad-btn', function(e) {
    const accion = $(this).data('action');
    const productoEnCarrito = $(this).closest('.producto-agregado');
    
    var precioTexto = productoEnCarrito.find('.precio-producto').text().trim();
    console.log("Texto de precio:", precioTexto);

    const precioProducto = parseFloat(precioTexto.replace('Precio: $', '').replace(',', ''));
    console.log("Precio convertido:", precioProducto);

    let cantidad = parseInt(productoEnCarrito.find('.cantidad').text());
    if(isNaN(cantidad)) {
        cantidad = 1;
    }
    console.log("Cantidad:", cantidad);

    console.log("Acción:", accion);
    console.log("Precio del producto:", precioProducto);
    console.log("Cantidad antes:", cantidad);
    
    if (accion === "incrementar") {
        cantidad += 1;
    } else if (accion === "decrementar" && cantidad > 1) {
        cantidad -= 1;
    }

    let total = cantidad * precioProducto;
    console.log("Cantidad después:", cantidad);
    console.log("Total calculado:", total);

    productoEnCarrito.find('.cantidad').text(cantidad);
    productoEnCarrito.find('.total').text(`Total: $${total.toFixed(2)}`);
});
$(document).on('click', '.eliminar-btn', function(e) {
    e.preventDefault();
    const productoEnCarrito = $(this).closest('.producto-agregado');
    productoEnCarrito.remove();
});

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
    productos.forEach(producto => {
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
                <a href="#" class="agregar-btn"><i class="fas fa-shopping-cart mr-2"></i>Agregar producto</a>
            </div>
        </div>`;
    });
    $('#productos-section').html(contenido);
}

});



</script>
@endsection