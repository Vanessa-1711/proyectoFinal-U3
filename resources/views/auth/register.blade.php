@extends('layouts.app')

@section('titulo')
    Registrate a gestor de productos
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class="md:w-4/12 bg-white p-6 rounded-1g shadow-xl">
            {{-- no validate para validar cosas del lado del serivdor --}}
            <form action="{{route('register')}}" method="POST" novalidate>
                {{-- csrf sirve para evitar ataques de bots y evitar llenar la tabla de datos basura --}}
                {{-- Tambien crea un token seguro --}}
                @csrf

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('name')}}" 
                        {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                        />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu username"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"  value="{{old('username')}}" />
                </div>
                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="text" placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}" />
                </div>
                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password de registro "
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" value="{{old('password')}}"/>

                </div>
                {{-- Password_confirmation --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Repetir Password de registro " class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror" value="{{old('password_confirmation')}}"/>
                </div>
                <input type="submit" value="Crear cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection