@extends('layouts.authApp')
@section('titulo')
    Login
@endsection

@section('contenido')
<main class="mt-0 transition-all duration-200 ease-in-out">
    <section>
      <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
        <div class="container z-1">
          <div class="flex flex-wrap -mx-3">
            <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
              <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0">
                  <h4 class="font-bold">Sign In</h4>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="flex-auto p-6">
                  <form role="form" action="{{route('login')}}" method="POST" novalidate>
                    @csrf

                    @if(session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{session('mensaje')}}
                        </p>
                    @endif
                    <div class="mb-4">
                      <input type="email" id="email" name="email" placeholder="Email" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('email') border-red-500 @enderror" value="{{old('email')}}" />
                      @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                      @enderror
                    </div>
                    <div class="mb-4">
                      <input type="password"  name="password" placeholder="Password" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid  bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('password') border-red-500 @enderror" value="{{old('password')}}" />
                      @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
              <div class="relative flex flex-col justify-center h-full bg-cover px-24 overflow-hidden bg-[url('https://planetaoffice.net/wp-content/uploads/2020/06/Punto-de-Venta.png')]">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection