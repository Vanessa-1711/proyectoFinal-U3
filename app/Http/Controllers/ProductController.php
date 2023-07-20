<?php

namespace App\Http\Controllers;
use auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Subcategoria;
use App\Models\Marca;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('productos.tablaProductos', compact('products'));
    }

    public function create()
    {
        $categorias = Categorias::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();
        return view('productos.crearProducto', compact('categorias', 'subcategorias','marcas'));
    }


    public function store(Request $request)
    {  
        $this->validate($request,[
            //Reglas de validacion 
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_compra' => 'required',
            'precio_venta' =>'required',
            'unidades_disponibles' =>'required',
            'marca_id' =>'required',
            'imagen' =>'required',


        ]);
        // dd($request->all());
        $product = new Product;
        $product->nombre = $request->nombre;
        $product->categoria_id = $request->categoria_id;
        $product->subcategoria_id = $request->subcategoria_id;
        $product->marca_id = $request->marca_id;
        $product->precio_compra = $request->precio_compra;
        $product->precio_venta = $request->precio_venta;
        $product->unidades_disponibles = $request->unidades_disponibles;
        $product->imagen = $request->imagen;
        $product->user_id = auth()->user()->id ;
        $product->save();
        $request->session()->flash('success', '¡El producto se ha registrado exitosamente!');

        return redirect()->route('tablaProductos');
    }


    /**
 * Display the specified resource.
 */
public function show(string $id)
{
    $product = Product::findOrFail($id);
    return view('productos.verProducto', compact('product'));
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(string $id)
{
    $product = Product::findOrFail($id);
    $categorias = Categorias::all();
        $subcategorias = Subcategoria::all();
    return view('productos.editarProducto', compact('product','categorias', 'subcategorias'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());
    return redirect('/products');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect('/products');
}
}
