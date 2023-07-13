<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />


    {{-- Estilos de tailwind --}}
    @vite('resources/css/app.css')

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/nucleo-svg.css')}}">
    <link rel="stylesheet" href="{{asset('css/argon-dashboard-tailwind.css')}}">

    <title>@yield('titulo')</title>
</head>
<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    @yield('contenido')
</body>
<!-- plugin for scrollbar  -->
<script src="{{asset('js/argon-dashboard-tailwind.js')}}"></script>
    <script src="{{asset('js/argon-dashboard-tailwind.min.js')}}"></script>
    <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/plugins/chartjs.min.js')}}"></script>
</html>