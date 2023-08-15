@extends('layouts.app')

@section('titulo')
    Dashboard
@endsection

@section('contenido_top')
    <!-- Sección superior de contenido -->
    <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
        <!-- Fondo con imagen -->
        <span class="fondo absolute top-0 left-0 w-full h-full  opacity-60"></span>
    </div>
@endsection

@section('contenido')
    <!-- Contenido principal -->

    <!-- Aquí puedes agregar cualquier contenido específico para el Dashboard -->

    <!-- Footer -->
    <footer class="pt-4">
        <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <!-- Texto del footer - Información de derechos de autor -->
                    <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                        ©
                        <script>
                            // Obtiene el año actual y lo muestra en el footer
                            document.write(new Date().getFullYear() + ",");
                        </script>
                        made by Vanessa García and Yanel Mireles
                        <!-- Aquí puedes cambiar "Vanessa García and Yanel Mireles" por los nombres de los creadores o desarrolladores del Dashboard -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Fin del footer -->

</div>
<!-- Fin del contenido principal - End cards -->
@endsection
