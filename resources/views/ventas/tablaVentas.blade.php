@extends('layouts.app')

@section('estilos')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js" integrity="sha512-sk0cNQsixYVuaLJRG0a/KRJo9KBkwTDqr+/V94YrifZ6qi8+OO3iJEoHi0LvcTVv1HaBbbIvpx+MCjOuLVnwKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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

    <!-- Agregar estilos personalizados aquí (si es necesario) -->
    <style>
      
    </style>

@endsection

@section('titulo')
    Listado de Ventas
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
        <!-- Botón Agregar Categoría -->
        <div class="flex justify-end mb-4">
            <!-- Botón para agregar nuevos clientes, enlazando a la ruta 'clientes.create' -->
            <a class="buttonAgregar px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" href="{{ route('ventas.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9a1 1 0 0 1 1-1h3V5a1 1 0 1 1 2 0v3h3a1 1 0 0 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 0 1-1-1z" clip-rule="evenodd" />
                </svg>
                Agregar Venta
            </a>
        </div>

        <!-- Tabla 1 -->
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <br>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                        <div class="my-4 flex justify-end space-x-2" style="display: flex;justify-content: end;margin-right: 30px;">
                            <button onclick="exportToPDF('myTable')" style="background-color: #e34444" class="btn mr-2 inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-red-600 hover:bg-red-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H176c-35.3 0-64 28.7-64 64V512H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"/></svg>    
                            </button>

                            <button onclick="exportToExcel('myTable')" style="background-color: #3d8d3d" class="btn inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-green-600 hover:bg-green-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>    
                            </button>
                        </div>
                            <div class="mx-4">
                                <!-- Mostrar el mensaje de error (si existe) después de realizar una acción -->
                                @if(session('mensaje'))
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" style="background-color: rgb(196 181 253);">
                                        {{session('mensaje')}}
                                    </p>
                                @endif
                                <table id="myTable" class="items-center table-auto mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Id</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Referencia</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Fecha</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Pago</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Total</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Cliente</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;">Creado por</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="text-align: center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $ventas)
                                            <tr>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" style="padding: 5px;!important">
                                                    <h6 class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $ventas->id }}</h6>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $ventas->referencia }}</p>
                                                </td>
                                                <!-- Continuar el mismo patrón para otras columnas -->
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">{{ $ventas->fecha }}</p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">${{ $ventas->pagocon}}</p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">${{ $ventas->total }}</p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <img src="{{ asset('uploads/' . $ventas->cliente->fotografia) }}" alt="{{ $ventas->cliente->nombre }}" class="text-xs font-semibold leading-tight dark:text-white  text-slate-400 rounded-xl" style="max-width: 50px; max-height: 200px;margin-right: 5px;">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $ventas->cliente->nombre }}</p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                    <p class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400" style="text-align: center ; margin-top: 10px;">100</p>
                                                </td>

                                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" style="margin-right: 8px; margin-left:8px;">
                                                    <div style="display: flex; align-items: center; justify-content: left;">
                                                        <a href="{{ route('ventas.show') }}" class="buttonVer text-blue-500 hover:text-blue-700 rounded-full bg-blue-500 text-white p-2" style="margin-right: 5px;">
                                                          <i class="far fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
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

    <!-- Incluir el script appTablas.js para la funcionalidad de la tabla -->
    <script src="{{ asset('js/appTablas.js') }}"></script>

    <!-- Código JavaScript para mostrar un mensaje de éxito si corresponde -->
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
        });

        function confirmDelete(clienteId) {
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
                    document.getElementById('deleteForm-' + clienteId).submit();
                }
            });
        }
    </script>
<script>
    function exportToPDF(tipo) {
  var maintable = document.getElementById('example');
  var pdfout = document.getElementById('pdfout');
  var doc = new jsPDF('p', 'pt', 'letter');
  var margin = 20;
  var scale = (doc.internal.pageSize.width - margin * 2) / document.body.clientWidth;
  var scale_mobile = (doc.internal.pageSize.width - margin * 2) / document.body.getBoundingClientRect();

  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      doc.html(maintable, {
          x: margin,
          y: margin,
          html2canvas: {
              scale: scale,
              ignoreElements: function (element) {
                  return element.classList.contains('exclude-column');
              }
          },
          callback: function (doc) {
              doc.save(tipo + '.pdf');
          }
      });
  } else {
      doc.html(maintable, {
          x: margin,
          y: margin,
          html2canvas: {
              scale: scale,
              ignoreElements: function (element) {
                  return element.classList.contains('exclude-column');
              }
          },
          callback: function (doc) {
              doc.save(tipo + '.pdf');
          }
      });
  }
}


function exportToExcel(tipo) {
  const table = document.querySelector('.mytable');
  const ws = XLSX.utils.table_to_sheet(table);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Marcas');
  XLSX.writeFile(wb, tipo + '.xlsx');
}

</script>
@endsection
