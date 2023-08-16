@extends('layouts.app')

@section('estilos')
    <!-- Agregar estilos y librerías necesarios para DataTables y DataTables Buttons -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <style>
        /* Agregar estilos personalizados aquí si es necesario */
    </style>
@endsection

@section('titulo')
Cotizacion
@endsection

@section('contenido_top')
<!-- Fondo para la sección superior -->
<div class="absolute bg-y-50 w-full top-0 min-h-75">
    <span class="fondo absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
</div>
@endsection


@section('contenido')
<div class="flex-none w-full px-3">
    <!-- Botón Agregar Categoría -->
    <div class="flex justify-end mb-4">
        <a class="buttonAgregar px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" href="{{ route('cotizaciones.create') }}">
            <!-- Icono y texto para el botón "Agregar Subcategoria" -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9a1 1 0 0 1 1-1h3V5a1 1 0 1 1 2 0v3h3a1 1 0 0 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 0 1-1-1z" clip-rule="evenodd" />
            </svg>
            Agregar Cotizacion
        </a>
    </div>

    <!-- Tabla de subcategorías -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <!-- Título de la tabla de subcategorías -->
                    <br>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="mx-4">
                            <!-- Mensaje de éxito en caso de operación exitosa -->
                            @if(session('mensaje'))
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" style="background-color: rgb(196 181 253);">
                                {{session('mensaje')}}
                            </p>
                            @endif
                            <!-- Tabla de datos con DataTables -->
                            <table id="myTable" class="items-center table-auto mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="display: flex; justify-content: center; align-items: center;">Id</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Nombre de cliente</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Referencia</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Fecha</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Estatus</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Gran Total</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cotizaciones as $cotizacion)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $cotizacion->id }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <img src="{{ asset('uploads/' . $cotizacion->cliente->fotografia) }}" alt="{{ $cotizacion->cliente->nombre }}" class="text-xs font-semibold leading-tight dark:text-white  text-slate-400 rounded-xl" style="max-width: 50px; max-height: 200px;">
                                                <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $cotizacion->cliente->nombre }}</p>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $cotizacion->referencia }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $cotizacion->fecha }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="{{ $cotizacion->estatus == 'pendiente' ? 'bg-red-500' : 'green-box' }} container">
                                                <div class="{{ $cotizacion->estatus == 'pendiente' ? 'red-box' : 'green-box' }}">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $cotizacion->estatus }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $cotizacion->total }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" style="width: 90px;">
                                            <div style="display: flex; align-items: center; justify-content: left;">
                                                <a href="{{ route('cotizaciones.show', $cotizacion->id) }}" class="buttonVer text-blue-500 hover:text-blue-700 rounded-full bg-blue-500 text-white p-2" style="margin-right: 5px;">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <!-- Primer botón - Editar -->
                                                <a href="{{ route('categorias.editarCategoria', $cotizacion->id) }}" class="buttonEditar text-blue-500 hover:text-blue-700 rounded-full bg-blue-500 text-white p-2" style="margin-right: 5px;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <!-- ... otras columnas aquí, similares a las anteriores ... -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para inicializar DataTables -->
<script src="{{ asset('js/appTablas.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verifica si hay un mensaje de éxito en la sesión
        const successMessage = '{{ session('success') }}';
        if (successMessage) {
            // Muestra el SweetAlert de éxito
            Swal.fire({
                title: 'Éxito',
                text: successMessage,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
        const infMessage = '{{ session('info') }}';
        if (infMessage) {
            // Muestra el SweetAlert de éxito
            Swal.fire({
                title: 'Error',
                text: infMessage,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        }
    });
    // Función para confirmar eliminación
    function confirmDelete(subcategoriId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, envía el formulario manualmente
                document.getElementById('deleteForm-' + subcategoriId).submit();
            }
        });
    }
</script>
@endsection