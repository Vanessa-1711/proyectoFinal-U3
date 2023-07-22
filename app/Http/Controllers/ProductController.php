<?php

namespace App\Http\Controllers;
use auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Subcategoria;
use App\Models\Marca;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
    $marcas = Marca::all();
    return view('productos.editarProducto', compact('product','categorias', 'subcategorias','marcas'));
}
public function Imagenstore(Request $request){
    //Identificar el archivo que se sube em dropzone
    $imagen=$request -> file('file');

    //Convertimos el arreglo input a formato JSON
    //return response()->json(['imagen' => $imagen->extension()]);

    //generar un id unico para cada una de las imagenes que se cargan al server
    $nombreImagen = Str::uuid() . ".". $imagen->extension();

    //implementar intervation image
    $imagenServidor = Image::make($imagen);

    //Agregamos efectos de Intervation image: Indicamos la medida de cada imagen 
    $imagenServidor->fit(1000,1000);

    //Movemos la imagen a un lugar fisico del servidor
    $imagenPath = public_path('imagenProductos'). '/'. $nombreImagen;

    //Pasamos la imagen de memoria al servidor
    $imagenServidor->save($imagenPath);
    

    //verificamos que el nombre del archivo se ponga como único
    return response()->json(['imagen'=>$nombreImagen]);

}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $this->validate($request, [
        // Reglas de validación
        'nombre' => 'required',
        'categoria_id' => 'required',
        'precio_compra' => 'required',
        'precio_venta' => 'required',
        'unidades_disponibles' => 'required',
        'marca_id' => 'required',
    ]);

    // Buscar el producto por el ID
    $product = Product::find($id);
    if (!$product) {
        // Si no se encuentra el producto, redireccionar o mostrar un error
        return redirect()->back()->with('error', 'Producto no encontrado');
    }

    // Obtener el nombre de la imagen actual del producto
    $imagenActual = $product->imagen;

    // Verificar si el valor del campo de imagen ha cambiado
    if ($request->imagen !== $product->imagen) {
        // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
        $product->imagen = $request->imagen;
    }

    // Actualizar los datos del producto con los nuevos valores del formulario
    $product->nombre = $request->nombre;
    $product->categoria_id = $request->categoria_id;
    $product->subcategoria_id = $request->subcategoria_id;
    $product->marca_id = $request->marca_id;
    $product->precio_compra = $request->precio_compra;
    $product->precio_venta = $request->precio_venta;
    $product->unidades_disponibles = $request->unidades_disponibles;

    // Guardar los cambios en la base de datos
    $product->save();

    // Establecer el mensaje de éxito solo si el producto se edita correctamente
    if ($product->wasChanged()) {
        $request->session()->flash('success', '¡El producto se ha editado exitosamente!');
    }

    return redirect()->route('tablaProductos');
}





/**
 * Remove the specified resource from storage.
 */
public function delete($id_producto)
{
    $product = Product::find($id_producto);
    // Eliminar la empresa emisora
    $product->delete();
    session()->flash('success', '¡El producto se ha eliminado exitosamente!');
    
}
}
