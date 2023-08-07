@extends('layouts.app')
@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="{{asset('css/estilosVentas.css')}}">

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
                <!-- Tarjetas del slider -->
                <div class="swiper-slide categoria-tarjeta w-1/2 md:w-1/3 lg:w-1/4 bg-white">
                    <a href="/pagina1" class=" w-1/2 md:w-1/3 lg:w-1/4 bg-white">
                        <img src="{{asset('img/logintienda6.png')}}" alt="Categoría 1">
                        <h3>Categoría 1</h3>
                    </a>
                </div>

                <div class="swiper-slide categoria-tarjeta w-1/2 md:w-1/3 lg:w-1/4 bg-white">
                    <img src="{{asset('img/logintienda6.png')}}" alt="Categoría 1">
                    <h3>Categoría 1</h3>
                </div>

                <div class="swiper-slide categoria-tarjeta w-1/2 md:w-1/3 lg:w-1/4 bg-white">
                    <a href="/pagina1" class=" w-1/2 md:w-1/3 lg:w-1/4 bg-white">
                        <img src="{{asset('img/logintienda6.png')}}" alt="Categoría 1">
                        <h3>Categoría 1</h3>
                    </a>
                </div>
                <!-- Flechas de navegación del slider -->

              <!-- Agrega más tarjetas de categorías aquí -->
            </div>
          </div>
        </div>
      </div>
      <!-- Sección de tarjetas de productos -->
    <div class="tarjetas-productos flex flex-wrap -mx-3 mt-6">
        <!-- Tarjeta de producto 1 -->
        <div class="producto-tarjeta bg-white w-48" style="margin-right: 10px; margin-bottom: 10px;">
            <div class="product-info relative">
                <!-- Imagen del producto -->
                <img src="{{asset('img/logintienda6.png')}}" alt="Producto 1" class="w-1/2 mx-auto my-4" style="transition: transform 0.3s ease;">

                    <h3 class="text-lg font-bold">Producto 1</h3>
                    <p>Precio: $XX</p>
                    <p>Marca: XYZ</p>  
                    <a href="#" class="agregar-btn"><i class="fas fa-shopping-cart mr-2"></i>Agregar</a>
            </div>
        </div>
        <div class="card-container">
            <div class="producto-tarjeta bg-white w-48 md:w-96">
                <div class="product-info relative">
                    <!-- Imagen del producto -->
                    <img src="{{asset('img/logintienda6.png')}}" alt="Producto 1" class="w-1/2 mx-auto my-4" style="transition: transform 0.3s ease;">

                    <h3 class="text-xl font-bold">Producto 1</h3>
                    <p>Precio: $XX</p>
                    <p>Marca: XYZ</p>
                </div>
            </div>
        </div>
        <div class="producto-tarjeta bg-white w-48 md:w-96" style="margin-right: 10px; margin-bottom: 10px;">
            <div class="product-info relative">
                <!-- Imagen del producto -->
                <img src="{{asset('img/logintienda6.png')}}" alt="Producto 1" class="w-1/2 mx-auto my-4" style="transition: transform 0.3s ease;">

                <h3 class="text-xl font-bold">Producto 1</h3>
                <p>Precio: $XX</p>
                <p>Marca: XYZ</p>
            </div>
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
                        </div>
                        <a class="buttonAgregar px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" href="{{ route('clientes.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9a1 1 0 0 1 1-1h3V5a1 1 0 1 1 2 0v3h3a1 1 0 0 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 0 1-1-1z" clip-rule="evenodd" />
                            </svg>
                            Agregar Clientes
                        </a>
                        <!-- Fin del nombre del producto -->

                        <!-- Fin de la imagen -->

                        <!-- Agregar otros detalles del producto aquí -->
                        <div class="producto-info p-4">
                            <p>Precio: $XX</p>
                            <p>Marca: XYZ</p>
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
@endsection