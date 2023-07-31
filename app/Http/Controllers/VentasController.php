<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.tablaVentas');
    }

    public function detallesTienda()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.detallesVentas');
    }
}
