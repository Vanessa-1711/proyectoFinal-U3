<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PuntoVentaController extends Controller
{
    public function index()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('puntoVenta.prueba');
    }
}
