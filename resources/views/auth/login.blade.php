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
            <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-9/12 lg:w-7/12 xl:w-4/12 border-4 rounded-lg h-96" style="width: 50%; height: 720px;margin-left: -100px;border-radius: 20px; background-color:#B38CC4; border: 2px solid #B38CC4;">
              <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border" style="margin-top: 80px;width: 70%; height: 80%; margin-left: auto; margin-right: auto; text-align: center;">
                <div class="p-6 pb-0 mb-0">
                  <img src="{{asset('img/usuario.png')}}" style="width: 30%; margin: 0 auto;" alt="">
                  <br>
                  <h4 class="font-bold">Iniciar Sesion</h4>
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
                      <label for="email" class="text-sm text-teal-500 font-bold mb-2" style="text-align: left!important;color:black;">Email</label>
                      <div class="relative">
                        <input type="email" id="email" name="email" placeholder="Email" style="background-color:#D5C0DF; color:black;" class="custom-input focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 pl-10 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('email') border-red-500 @enderror" value="{{old('email')}}"  />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                          <i class="fas fa-envelope" style="color:#734D84"></i>
                        </div>
                      </div>
                      @error('email')
                      <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-4">
                      <label for="password" class="text-sm font-bold mb-2"  style="text-align: left!important;color:black;">Password</label>
                      <div class="relative">
                        <input type="password" name="password" placeholder="Password" style="background-color:#D5C0DF; color:black;" class="custom-input focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding p-3 pl-10 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('password') border-red-500 @enderror" value="{{old('password')}}" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                          <i class="fas fa-lock " style="color:#734D84"></i>
                        </div>
                      </div>
                      @error('password')
                      <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                      @enderror
                    </div>
                    <a class="font-bold uppercase text-zinc-50 text-sm"  href="{{route('register')}}"> Registrar usuario</a>
                    <div class="text-center">
                      <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25" style="background-color:#734D84;">Sign in</button>
                    </div>

                  </form>
                </div>

            </div>
            <div class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex"style="width: 55%;">
              <div id="gallery" class="relative w-full h-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-full overflow-hidden rounded-lg">

                  <!-- Item 3 -->
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/logintienda6.png')}}" class="absolute block object-cover w-full h-full" alt="">
                  </div>
                  <!-- Item 4 -->
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/logintienda4.png')}}" class="absolute block object-cover w-full h-full" alt="">
                  </div>
                  <!-- Item 5 -->
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/logintienda5.png')}}" class="absolute block object-cover w-full h-full" alt="">
                  </div>
                </div>
                <!-- Carousel dots -->
                <!-- Carousel dots -->
                <div class="absolute left-0 right-0 bottom-2 flex justify-center">
                  <button type="button" class="w-3 h-3 rounded-full bg-gray-300 mx-1 focus:outline-none" data-carousel-dot></button>
                  <button type="button" class="w-3 h-3 rounded-full bg-gray-300 mx-1 focus:outline-none" data-carousel-dot></button>
                  <button type="button" class="w-3 h-3 rounded-full bg-gray-300 mx-1 focus:outline-none" data-carousel-dot></button>
                  <button type="button" class="w-3 h-3 rounded-full bg-gray-300 mx-1 focus:outline-none" data-carousel-dot></button>
                  <button type="button" class="w-3 h-3 rounded-full bg-gray-300 mx-1 focus:outline-none" data-carousel-dot></button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>
@endsection