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

class DevolucionesVentasController extends Controller
{
    public function __construct()
    {
        // Se asegura de que el usuario esté autenticado antes de acceder a las rutas definidas en este controlador
        // El método 'except()' permite especificar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }
    public function index()
    {
        $devoluciones = DevolucionVenta::all();

        return view('devoluciones.tablaDevoluciones', compact('devoluciones'));
    }

    public function create()
    {
        $ventas = Venta::all();
        return view('devoluciones.gestorDevoluciones', compact('ventas'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        
        $ventaId = $request->input('referencia');
        $productos = $request->input('productos');
        $cantidadesDevueltas = $request->input('cantidades_devueltas');
        
        foreach ($productos as $producto ) {
            
            $cantidadDevuelta = $cantidadesDevueltas[$producto];
            
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
    public function productos($ventaId){
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
    



    public function show(DevolucionVenta $devolucion)
    {
        return view('devoluciones.show', compact('devolucion'));
    }

    public function edit(DevolucionVenta $devolucion)
    {
        return view('devoluciones.edit', compact('devolucion'));
    }

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

    public function destroy(DevolucionVenta $devolucion)
    {
        $devolucion->delete();

        return redirect()->route('devoluciones.index')->with('mensaje', 'Devolución eliminada exitosamente');
    }
}
