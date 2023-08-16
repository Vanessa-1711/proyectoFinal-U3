<?php

namespace App\Http\Controllers;

use App\Models\DevolucionVenta;
use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

// Controlador para gestionar devoluciones de ventas
class DevolucionesVentasController extends Controller
{
    public function __construct()
    {
        // Middleware para requerir autenticación en todos los métodos, excepto los excluidos.
        $this->middleware('auth');
    }

    // Muestra una lista de todas las devoluciones
    public function index()
    {
        $devoluciones = DevolucionVenta::all();

        return view('devoluciones.tablaDevoluciones', compact('devoluciones'))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'no-cache'
        ]);
    }

    // Muestra un formulario para registrar una nueva devolución
    public function create()
    {
        $ventas = Venta::all();
        return view('devoluciones.gestorDevoluciones', compact('ventas'));
    }

    // Guarda una nueva devolución en la base de datos
    public function store(Request $request)
    {
        $userId = Auth::id();
        
        $ventaId = $request->input('referencia');
        $productos = $request->input('productos');
        $cantidadesDevueltas = $request->input('cantidades_devueltas');
        
        foreach ($productos as $producto ) {
            
            $cantidadDevuelta = $cantidadesDevueltas[$producto];
            
            // Si la cantidad devuelta es mayor que 0, se crea la devolución
            if ($cantidadDevuelta > 0) {
                DevolucionVenta::create([
                    'venta_id' => $request->referencia,
                    'fecha_devolucion'=>Carbon::now(),
                    'products_id' => $producto,
                    'cantidad_devuelta' => $cantidadDevuelta,
                    'user_id' => $userId,
                ]);
            }
        }

        return redirect()->route('devoluciones')->with('mensaje', 'Devolución creada exitosamente');
    }

    // Retorna los productos relacionados a una venta
    public function productos($ventaId)
    {
        $venta = Venta::find($ventaId);
    
        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada'], 404);
        }
    
        $productosComprados = $venta->detalleVenta()
        ->with(['producto' => function ($query) {
            $query->select('id', 'imagen', 'nombre', 'precio_venta');
        }])
        ->select('products_id', 'cantidad')
        ->get();
    
        return response()->json(['productos' => $productosComprados]);
    }

    // Muestra detalles de una devolución específica
    public function show(DevolucionVenta $devolucion)
    {
        return view('devoluciones.show', compact('devolucion'));
    }

    // Muestra un formulario para editar una devolución específica
    public function edit(DevolucionVenta $devolucion)
    {
        return view('devoluciones.edit', compact('devolucion'));
    }

    // Actualiza una devolución en la base de datos
    public function update(Request $request, DevolucionVenta $devolucion)
    {
        $data = $request->validate([
            'nombre_producto' => 'required',
            'fecha_devolucion' => 'required',
            'cliente' => 'required',
            'estatus' => 'required',
            'total_pagado' => 'required',
            'adeudo' => 'required',
            'estatus_pago' => 'required',
            'imagen' => 'required'
        ]);

        $devolucion->update($data);

        return redirect()->route('devoluciones.index')->with('mensaje', 'Devolución actualizada exitosamente');
    }

    // Elimina una devolución de la base de datos
    public function destroy(DevolucionVenta $devolucion)
    {
        $devolucion->delete();

        return redirect()->route('devoluciones.index')->with('mensaje', 'Devolución eliminada exitosamente');
    }
}
