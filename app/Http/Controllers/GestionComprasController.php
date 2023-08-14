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

        return view('gestorCompras.tablaCompras', compact('compras'));
    }



    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Product::all();
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

    public function store(Request $request)
    {
        $this->validate($request,[
            'fecha'=>'required',
            'referencia'=>'required|unique:compras',
            'descripcion'=>'required',
            'proveedor_id'=>'required',
        ]); 
        //dd($request->all());

        // Almacena la nueva compra en la base de datos.
        $compra = new Compra();
        // Aquí asignas los valores de $request a los campos de $compra
        $compra->proveedores_id = $request->proveedor_id;
        $compra->fecha = $request->fecha;
        $compra->referencia = $request->referencia;
        $compra->descripcion = $request->descripcion;
        $compra->subtotal = $request->subtotal_input;
        $compra->total = $request->total_input;
        $compra->save();

        $productosCarrito = json_decode($request->carrito, true);
        // Aquí guardas los detalles de la compra.
        foreach ($productosCarrito as $productoData) {
            $producto = Product::find($productoData['product_id']); // Asegúrate de que los objetos en el carrito tengan el atributo 'product_id'
            if ($producto) {
                // Actualizar el stock del producto
                $producto->unidades_disponibles += $productoData['stock'];
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
    }
     //Funcion para redirigir a la vista de editar compra
     public function show($id_compra){
        $compra = Compra::findOrFail($id_compra);
        $detalle_compra=DetalleCompra::with('producto')->where('compras_id',$id_compra)->get();
        return view('gestorCompras.verCompra',compact('compra'),['detalle_compra'=>$detalle_compra]);
    }
}
