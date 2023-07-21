@extends('layouts.app')

@section('titulo')
    Productos Detalles
@endsection

@section('contenido_top')
    <div
        class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection








@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
  <!-- Formulario de registro de categoría -->
  <div class="flex flex-wrap -mx-3">
    <!-- Columna izquierda - Código QR e información del producto -->
    <div class="flex-none w-full md:w-1/2 px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="bg-white shadow-md rounded-lg p-4">
          <div class="flex justify-center">
            <!-- Muestra la imagen del código QR -->
            <img src="{{ asset('img/codigoBarras.png') }}" alt="Código QR del producto" style="width: 200px;">
          </div>
          <div class="mt-4">
            <!-- Mostrar los números ingresados por el usuario aquí -->
            <p class="text-center text-lg font-bold">Código: <span id="numerosIngresados">{{ $product->id }}</span></p>
          </div>
          <!-- Aquí irán los detalles del producto -->
          <div class="flex flex-col justify-center items-center md:items-start mt-4">
            <table class="w-full mt-4">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">ID</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Nombre</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Categoría</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->categoria->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Subcategoría</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->subcategoria ? $product->subcategoria->nombre : 'Sin subcategoría'}}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Precio de compra</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">$ {{ $product->precio_compra }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Precio de venta</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">$ {{ $product->precio_venta }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Unidad disponible</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->unidades_disponibles }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Marca</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->marca->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">Creado por</td>
                        <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $product->creador->name}}</td>
                    </tr>
            
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Columna derecha - Imagen del producto -->
    <div class="flex-none w-full md:w-1/2 px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        
        <div class="flex flex-col items-center mt-4">
            <div class="flex justify-center">
              <img src="{{ asset('imagenProductos/' . $product->imagen) }}" alt="Imagen del producto" style="width: 200px;">
            </div>
            <p class="text-center mt-2">{{ $product->imagen }}</p>
            </div>
            <div class="flex justify-center mb-4">
                <a class="buttonAgregar px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"  href="{{ route('products.edit', $product->id) }}">
                    <i class="fas fa-pencil-alt"></i>
                    Editar Productos
                </a>
            </div>
        </div>
      
    </div>
  </div>
</div>
@endsection