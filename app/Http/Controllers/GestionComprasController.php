<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\Product;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class GestionComprasController extends Controller
{
    //
    public function index()
    {
        //$compras = Compra::with('supplier')->get();
        return view('gestorCompras.tablaCompras');
    }

    public function index2()
    {
        //$compras = Compra::with('supplier')->get();
        return view('gestorCompras.tablaCompras2');
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Product::all();
        return view('gestorCompras.crearCompra', ['proveedores' => $proveedores, 'productos' => $productos]);
    }
    public function create2()
    {
        $proveedores = Proveedor::all();
        $productos = Product::all();
        return view('gestorCompras.crearCompra2', ['proveedores' => $proveedores, 'productos' => $productos]);
    }

    //Funcion para obtener producto
    public function getProduct($id_producto)
    {
        $producto = Product::find($id_producto);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Supongamos que el impuesto es un 15% del precio del producto
        $impuesto = $producto->precio_compra * 0.15;
        $impuesto_truncado = round($impuesto);
        // Agregamos el impuesto al objeto producto
        $producto->costo_total = $producto->precio_venta + $impuesto_truncado;
        $producto->impuesto = $impuesto_truncado;

        return response()->json($producto);
    }
}
