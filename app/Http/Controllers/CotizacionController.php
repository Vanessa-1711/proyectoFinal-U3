<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Product;
use App\Models\DetalleCotizacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function __construct()
    {
        // Se asegura de que el usuario esté autenticado antes de acceder a las rutas definidas en este controlador
        // El método 'except()' permite especificar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }
    public function index()
    {
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.tablaCotizaciones', compact('cotizaciones'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Product::all();
        
        if ($clientes->isEmpty() || $productos->isEmpty()) {
            $message = '';
        
            if ($clientes->isEmpty() && $productos->isEmpty()) {
                $message = 'Es necesario tener clientes y productos registrados.';
            } elseif ($clientes->isEmpty()) {
                $message = 'Es necesario tener clientes registrados.';
            } else {
                $message = 'Es necesario tener productos registrados.';
            }
        
            session()->flash('info', $message);
            return redirect('/cotizaciones');
        }
        
        return view('cotizaciones.gestorCotizaciones', compact('productos','clientes'));
    }

    public function getProduct($id_producto)
    {
        $producto = Product::find($id_producto);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $impuesto = $producto->precio_venta * 0.15;
        $impuesto_truncado = round($impuesto);
        $producto->costo_total = $producto->precio_venta + $impuesto_truncado;
        $producto->impuesto = $impuesto_truncado;

        return response()->json($producto);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:255|unique:cotizaciones',
            'cliente_id' => 'required',
            'descripcion' => 'nullable|string',
            'estatus' => 'required|string|in:enviada,pendiente',
        ]);

        $cotizacion = new Cotizacion();
        $cotizacion->cliente_id = $request->cliente_id;
        $cotizacion->fecha = $request->fecha;
        $cotizacion->referencia = $request->referencia;
        $cotizacion->descripcion = $request->descripcion;
        $cotizacion->subtotal = $request->subtotal_input;
        $cotizacion->total = $request->total_input;
        $cotizacion->estatus = $request->estatus;
        $cotizacion->save();

        $productosCarrito = json_decode($request->carrito, true);
        foreach ($productosCarrito as $productoData) {
            $producto = Product::find($productoData['product_id']);
            if ($producto) {
                $detalle = new DetalleCotizacion();
                $detalle->cotizaciones_id = $cotizacion->id;
                $detalle->products_id = $producto->id;
                $detalle->sale = $productoData['sale'];
                $detalle->precio_venta = $productoData['precio_venta'];
                $detalle->subtotal = $productoData['subtotal'];
                $detalle->total = $productoData['total'];
                $detalle->save();
            }
        }

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización creada con éxito.');
    }

    public function show($id_cotizacion){
        $cotizacion = Cotizacion::findOrFail($id_cotizacion);
        $detalle_cotizacion = DetalleCotizacion::with('producto')->where('cotizaciones_id',$id_cotizacion)->get();
        return view('cotizaciones.verCotizaciones', compact('cotizacion'), ['detalle_cotizacion' => $detalle_cotizacion]);
    }

    public function edit($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $productos = Product::all();
        return view('cotizaciones.edit', compact('cotizacion', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:255',
            'producto_id' => 'required|integer|exists:products,id',
            'total' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacion->update($request->all());

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización actualizada con éxito.');
    }

    public function destroy($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacion->delete();

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización eliminada con éxito.');
    }
}
