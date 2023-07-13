<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        // Mostrar la vista de login de usuarios
        return view('dashboard');
    }
}
