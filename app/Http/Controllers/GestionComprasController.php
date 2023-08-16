<?php

namespace App\Http\Controllers;
use App\Models\Compra;
use App\Models\Product;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class GestionComprasController extends Controller
{
    //
    public function index()
{
    $compras = Compra::all();

    return response()->view('gestorCompras.tablaCompras', compact('compras'))
        ->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'no-cache'
        ]);
}



    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Product::where('eliminado', 0)->get();
        if ($proveedores->isEmpty() || $productos->isEmpty()) {
            $message = '';
        
            if ($proveedores->isEmpty() && $productos->isEmpty()) {
                $message = 'Es necesario tener proveedores y productos registradas.';
            } elseif ($proveedores->isEmpty()) {
                $message = 'Es necesario tener proveedores registradas.';
            } else {
                $message = 'Es necesario tener productos registradas.';
            }
        
            // Si alguna de las dos colecciones está vacía, crea un mensaje de alerta y redirige al usuario
            session()->flash('info', $message);
            return redirect('/compras');
        }
        return view('gestorCompras.crearCompra', ['proveedores' => $proveedores, 'productos' => $productos]);
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

    public function store(Request $request){
        $this->validate($request,[
            'fecha'=>'required',
            'proveedor_id'=>'required',
            'referencia'=>'required|unique:compras',
            'descripcion'=>'required',
            'carrito'=>'required'
        ]); 

        // Almacena la nueva compra en la base de datos.
        $compra = new Compra();
        // Aquí asignas los valores de $request a los campos de $compra
        $compra->proveedores_id = $request->proveedor_id;
        $compra->fecha = $request->fecha;
        $compra->referencia = $request->referencia;
        $compra->descripcion = $request->descripcion;
        $compra->subtotal = $request->subtotal_input;
        $compra->total = $request->total_input;
        $compraExitosa = $compra->save();

        if ($compraExitosa) {
            $productosCarrito = json_decode($request->carrito, true);
            // Aquí guardas los detalles de la compra.
            foreach ($productosCarrito as $productoData) {
                $producto = Product::find($productoData['product_id']); 
                if ($producto) {
                    // Actualizar el stock del producto
                    $producto->unidades_disponibles += $productoData['stock'];
            
                    // Actualizar el precio de compra si ha cambiado
                    if ($producto->precio_compra != $productoData['precio_compra']) {
                        $producto->precio_compra = $productoData['precio_compra'];
                    }
            
                    $producto->save();
            
                    // Guardar el detalle de la compra
                    $detalle = new DetalleCompra();
                    $detalle->compras_id = $compra->id;
                    $detalle->products_id = $producto->id;
                    $detalle->stock = $productoData['stock'];
                    $detalle->precio_compra = $productoData['precio_compra'];
                    $detalle->subtotal = $productoData['subtotal'];
                    $detalle->total = $productoData['total'];
                    $detalle->save();
                }
            }
            return redirect()->route('compras.index')->with('success', 'Compra realizada con éxito');
        }else{
            return redirect()->route('compras.index');
        }
    }

     //Funcion para redirigir a la vista de editar compra
     public function show($id_compra){
        $compra = Compra::findOrFail($id_compra);
        $detalle_compra=DetalleCompra::with('producto')->where('compras_id',$id_compra)->get();
        return view('gestorCompras.verCompra',compact('compra'),['detalle_compra'=>$detalle_compra]);
    }
}
