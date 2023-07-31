@extends('layouts.app')
@section('titulo')
    <!-- Título para esta página -->
    Detalles de Ventas
@endsection

@section('contenido_top')
    <!-- Contenido adicional para la parte superior de la página -->
    <div class="absolute bg-y-50 w-full top-0 min-h-75">
        <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection


@section('contenido')
    <!-- Contenido principal de la página -->
    <div class="flex-none w-full px-3">
        <!-- Tabla 1 -->
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                            <h3 class="mb-0 dark:text-white">SL0101</h3>
                        </div>
                        <hr class="linea w-full border-t border-gray-300 mt-2">

                        <br>
                        <div class="flex">
                            
                            <div class="flex-1 px-3">
                                
                                <h6 style="color: #8078C1;">Información del cliente</h6>
                                <!--Nombre del cliente -->
                                <p>Vanessa</p>
                                <!--correo del cliente -->
                                <p>vanessa-17@live.com</p>
                                <!--Nombre del cliente -->
                                <p>123456780</p>
                                <!--dirección del cliente -->
                                <p>Cd Victoria</p>
                            </div>
                            <div class="flex-1 px-3">
                                
                                <h6 style="color: #8078C1;">Información de la compañía</h6>
                                <p>DGT</p>
                                <p>admin@example.com</p>
                                <p>admin@example.com</p>
                                <p>Cd Victoria</p>
                            </div>
                            <div class="flex-1 px-3">
                                <h6 style="color: #8078C1;">Información de la factura</h6>
                                <div class="flex justify-between">
                                    <p>Rerefencia</p>
                                    <p class="text-right" >SL0101</p>
                                </div>
                                <div class="flex justify-between">
                                    <p>Estado de pago</p>
                                    <p class="text-right" style="color: #82C554;">Pagado</p>
                                </div>
                                <div class="flex justify-between">
                                    <p>Estado</p>
                                    <p class="text-right" style="color: #82C554;">Completo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
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
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">QTY</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Precio</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Descuento</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">TAX</th>
                                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" style="padding: 5px;!important">
                                                        <h6 class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">1</h6>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">Vanessa</p>
                                                    </td>
                                                    <!-- Continuar el mismo patrón para otras columnas -->
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">SL0101</p>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">30/Julio2023</p>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">0</p>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">0</p>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                        <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">100</p>
                                                    </td>

                                                </tr>
                                            
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection

