<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Product;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.tablaCotizaciones', compact('cotizaciones'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Product::all();
        return view('cotizaciones.gestorCotizaciones', compact('productos','clientes'));
    }

    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:255',
            'producto_id' => 'required|integer|exists:products,id',
            'total' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'estatus' => 'required|string|in:enviada,pendiente', // 
        ]);

        // Lógica de almacenamiento
        Cotizacion::create($request->all());

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización creada con éxito.');
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

    public function edit($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $productos = Product::all();
        return view('cotizaciones.edit', compact('cotizacion', 'productos'));
    }

    public function update(Request $request, $id)
    {
        // Validaciones
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'referencia' => 'required|string|max:255',
            'producto_id' => 'required|integer|exists:products,id',
            'total' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            // ... (añade más campos según necesites)
        ]);

        // Lógica de actualización
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

    // Si necesitas más métodos o funcionalidades, puedes agregarlos aquí.
}
