<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Carbon\Carbon;

class VentasController extends Controller
{
    public function index()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        $ventas = Venta::all();
        return view('ventas.tablaVentas', ['ventas' => $ventas]);
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

    public function getAllProducts(){
        $productos = Product::with('marca')->get();
        return response()->json($productos);
    }

    public function getProductsByCategory($categoriaId){
        $productos = Product::with('marca')->where('categoria_id', $categoriaId)->get();
        
        foreach ($productos as $producto) {
            $impuesto = $producto->precio_compra * 0.15;
            $producto->costo_total = $producto->precio_venta + round($impuesto);
            $producto->impuesto = round($impuesto);
        }

        return response()->json($productos);
    }

    public function store(Request $request)
    {  
        // Validar los campos del formulario antes de almacenar el producto
        $this->validate($request, [
            'referencia' => 'required',
            'pagocon' => 'required',
            'cambio' => 'required',
            'subtotal_input' => 'required',
            'iva_input' => 'required',
            'total_input' => 'required',
            'cliente_id' => 'required',
            'carrito' => 'required',
        ]);
        
        
        $venta = new Venta();
        // Aquí asignas los valores de $request a los campos de $compra
        $venta->referencia = $request->referencia;
        $venta->fecha = Carbon::now();
        $venta->total = $request->total_input;
        $venta->subtotal = $request->subtotal_input;
        $venta->iva = $request->iva_input;
        $venta->pagocon = $request->pagocon;
        $venta->cambio = $request->cambio;
        $venta->cliente_id = $request->cliente_id;
        $ventaExitosa = $venta->save();
        if ($ventaExitosa) {
            $productosCarrito = json_decode($request->carrito, true);
            // Aquí guardas los detalles de la compra.
            foreach ($productosCarrito as $productoData) {
                $producto = Product::find($productoData['id']); 
                if ($producto) {
                    // Actualizar el stock del producto
                    $producto->unidades_disponibles -= $productoData['stock'];
                    $producto->save();
                    
                    // Guardar el detalle de la compra
                    $detalle = new DetalleVenta();
                    $detalle->venta_id = $venta->id;
                    $detalle->products_id = $producto->id;
                    $detalle->cantidad = $productoData['stock'];
                    $detalle->save();
                }
            }

            return redirect()->route('ventas')->with('success', 'Compra realizada con éxito');
        } else {
            return redirect()->route('ventas');
        }

        
        
    }


    
    


    public function detallesTienda()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.detallesVentas');
    }
}
