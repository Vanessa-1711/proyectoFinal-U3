<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        // Para verificar que el user este autenticado
        // except() es para indicar cuales metodos pueden usarse sin autenticarse
        $this->middleware('auth');
    }
    public function index(){
        // Mostrar la vista de login de usuarios
        return view('dashboard');
    }
}
