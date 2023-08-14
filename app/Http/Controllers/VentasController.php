<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Cliente;

class VentasController extends Controller
{
    public function index()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.tablaVentas');
    }
    public function create()
    {
        $categorias = Categorias::all();
        $productos = Product::all();
        $clientes = Cliente::all();
        if ($categorias->isEmpty() || $productos->isEmpty()) {
            $message = '';
        
            if ($categorias->isEmpty() && $productos->isEmpty()) {
                $message = 'Es necesario tener categorias y productos registradas.';
            } elseif ($categorias->isEmpty()) {
                $message = 'Es necesario tener categorias registradas.';
            } else {
                $message = 'Es necesario tener productos registradas.';
            }
        
            // Si alguna de las dos colecciones está vacía, crea un mensaje de alerta y redirige al usuario
            session()->flash('info', $message);
            return redirect('/ventas');
        }

        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.prueba', ['categorias' => $categorias, 'productos' => $productos,'clientes' => $clientes]);
    }

    public function getAllProducts()
    {
        $productos = Product::with('marca')->get();
        return response()->json($productos);
    }

    public function getProductsByCategory($categoriaId)
{
    $productos = Product::with('marca')->where('categoria_id', $categoriaId)->get();
    
    foreach ($productos as $producto) {
        $impuesto = $producto->precio_compra * 0.15;
        $producto->costo_total = $producto->precio_venta + round($impuesto);
        $producto->impuesto = round($impuesto);
    }

    return response()->json($productos);
}

    
    


    public function detallesTienda()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.detallesVentas');
    }
}
