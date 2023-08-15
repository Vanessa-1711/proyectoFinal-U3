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
                            <input readonly  type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ $compra->proveedor->nombre }}">
                        </div>
                        <div class="w-full mr-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha de compra:</label>
                            <input readonly  type="date" id="fecha" name="fecha" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('fecha') border-red-500 @enderror" value="{{ $compra->fecha }}">
                        </div>
                        <div class="w-full mr-4">
                            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
                            <input  readonly  type="text" id="referencia" name="referencia" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('referencia') border-red-500 @enderror" value="{{ $compra->referencia }}">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalle_compra as $detalles) 
                                    <tr>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <img src="{{ asset('uploads/' . $detalles->producto->imagen) }}" alt="{{ $detalles->producto->nombre }}" class="text-xs font-semibold leading-tight dark:text-white  text-slate-400 rounded-xl" style="max-width: 50px; max-height: 200px;">
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->producto->nombre }}</p>
                                    </td>  
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->producto->unidades_disponibles}}</p>
                                    </td>  
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->stock}}</p>
                                    </td> 
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->precio_compra}}</p>
                                    </td> 
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->subtotal}}</p>
                                    </td> 
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->producto->precio_venta}}</p>
                                    </td> 
                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $detalles->total}}</p>
                                    </td> 
                                    </tr>   
                                    @endforeach
                                            
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
                                <textarea readonly  class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('descripcion') border-red-500 @enderror" id="descripcion" name="descripcion" rows="4" placeholder="Ingresa la descripción de la compra...">{{ $compra->descripcion }}</textarea>
                            </div>
                            <div class="mt-4 text-center">
                                <button id="btnCancelar" type="button" class="buttonAgregar px-8 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-blue-500 hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25 mx-auto">
                                    Regresar
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
                                @php
                                    $iva = $compra->total * 0.16;
                                @endphp
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Subtotal:</label>
                                    <span name="subtotal" id="subtotal" class="text-lg font-semibold">${{ number_format($compra->subtotal, 2) }}</span>
                                </div>

                                <!-- IVA -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">IVA (16%):</label>
                                    <span id="iva-value" class="text-lg font-semibold">${{ number_format($iva, 2) }}</span>
                                </div>

                                <!-- Total -->
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Total:</label>
                                    <span name="total" id="total" class="text-lg font-semibold">${{ number_format($compra->total, 2) }}</span>
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
<script>
  document.getElementById('btnCancelar').addEventListener('click', function() {
        window.location.href = '{{ route('compras.index') }}';
      });
</script>
<!-- Script para inicializar Select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

@endsection
