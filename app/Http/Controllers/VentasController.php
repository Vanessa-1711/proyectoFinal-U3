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
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function index()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        $ventas = Venta::all();
        return view('ventas.tablaVentas', ['ventas' => $ventas])->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'no-cache'
        ]);
    }
    public function create()
    {
        $categorias = Categorias::where('eliminado', 0)->get();
        $productos = Product::where('eliminado', 0)->get();
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
        $productos = Product::with('marca')->where('eliminado', 0)->get();
        return response()->json($productos);
    }

    public function getProductsByCategory($categoriaId){
        $productos = Product::with('marca')
                            ->where('categoria_id', $categoriaId)
                            ->where('eliminado', 0)
                            ->get();
            
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
            'referencia' => 'required|unique:venta',
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

    public function show($id)
    {
        // Buscar el producto con el ID proporcionado
        $venta = Venta::with('cliente')->find($id);
        $detalles = DetalleVenta::with('producto')->where('venta_id', $id)->get();
        $venta = Venta::findOrFail($id);
        return view('ventas.detallesVentas')->with(['venta' => $venta,'detalles' => $detalles ]);

    }


    
    


    public function detallesTienda()
    {
        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('ventas.detallesVentas');
    }
}
