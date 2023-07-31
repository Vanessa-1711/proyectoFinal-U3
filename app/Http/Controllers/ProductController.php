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
    public function __construct()
    {
        // Middleware para verificar que el usuario esté autenticado
        $this->middleware('auth');
    }

    // Método para mostrar todos los productos en una tabla
    public function index()
    {
        $products = Product::all();
        return view('productos.tablaProductos', compact('products'));
    }

    // Método para mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $categorias = Categorias::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();
        return view('productos.crearProducto', compact('categorias', 'subcategorias', 'marcas'));
    }

    // Método para almacenar un nuevo producto en la base de datos
    public function store(Request $request)
    {  
        // Validar los campos del formulario antes de almacenar el producto
        $this->validate($request,[
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'unidades_disponibles' => 'required',
            'marca_id' => 'required',
            'imagen' => 'required',
        ]);
        
        // Crear una nueva instancia del modelo Product y asignar los valores del formulario
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
        
        // Mostrar un mensaje de éxito y redireccionar a la página de la tabla de productos
        $request->session()->flash('success', '¡El producto se ha registrado exitosamente!');
        return redirect()->route('tablaProductos');
    }

    // Método para mostrar los detalles de un producto específico
    public function show(string $id)
    {
        // Buscar el producto con el ID proporcionado
        $product = Product::findOrFail($id);
        return view('productos.verProducto', compact('product'));
    }

    // Método para mostrar el formulario para editar un producto existente
    public function edit(string $id)
    {
        // Buscar el producto con el ID proporcionado
        $product = Product::findOrFail($id);
        $categorias = Categorias::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();
        return view('productos.editarProducto', compact('product', 'categorias', 'subcategorias', 'marcas'));
    }

    // Método para almacenar la imagen de un producto usando Intervention Image
    public function Imagenstore(Request $request){
        // Identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        // Generar un ID único para cada una de las imágenes que se cargan al servidor
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Implementar Intervention Image
        $imagenServidor = Image::make($imagen);

        // Agregar efectos de Intervention Image: Indicar la medida de cada imagen 
        $imagenServidor->fit(1000, 1000);

        // Movemos la imagen a un lugar físico del servidor
        $imagenPath = public_path('imagenProductos') . '/' . $nombreImagen;

        // Pasar la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);

        // Verificar que el nombre del archivo se ponga como único
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Método para actualizar un producto existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar el producto
        $this->validate($request, [
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

    // Método para eliminar un producto de la base de datos
    public function delete($id_producto)
    {
        $product = Product::find($id_producto);
        // Eliminar el producto
        $product->delete();
        session()->flash('success', '¡El producto se ha eliminado exitosamente!');
    }
}
