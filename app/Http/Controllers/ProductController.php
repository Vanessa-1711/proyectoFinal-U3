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
use Illuminate\Support\Facades\Validator;

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
        $products = Product::where('eliminado', 0)->get();
        return view('productos.tablaProductos', compact('products'));
    }

    // Método para mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $categorias = Categorias::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();
        if ($categorias->isEmpty() || $marcas->isEmpty()) {
            $message = '';
        
            if ($categorias->isEmpty() && $marcas->isEmpty()) {
                $message = 'Es necesario tener categorías y marcas registradas.';
            } elseif ($categorias->isEmpty()) {
                $message = 'Es necesario tener categorías registradas.';
            } else {
                $message = 'Es necesario tener marcas registradas.';
            }
        
            // Si alguna de las dos colecciones está vacía, crea un mensaje de alerta y redirige al usuario
            session()->flash('info', $message);
            return redirect('/products');
        }
        return view('productos.crearProducto', compact('categorias', 'subcategorias', 'marcas'));
    }

    // Método para almacenar un nuevo producto en la base de datos
    public function store(Request $request)
    {  
        // Validar los campos del formulario antes de almacenar el producto
        $this->validate($request,[
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required',
            'marca_id' => '',
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
        $product->eliminado = 0;
        $product->user_id = auth()->user()->id ;
        $product->save();
        
        // Mostrar un mensaje de éxito y redireccionar a la página de la tabla de productos
        $request->session()->flash('success', '¡El producto se ha creado exitosamente!');
        return redirect()->route('tablaProductos');
    }
    public function getSubcategorias($categoria_id)
    {
        $subcategorias = Subcategoria::where('categoria_id', $categoria_id)->get();
        return response()->json($subcategorias);
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
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

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
            'marca_id' => '',
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

    /* Método para eliminar un producto de la base de datos
    public function delete($id_producto)
    {
        $product = Product::find($id_producto);
        // Eliminar el producto
        // Comprobamos si el producto tiene imagen asociada
        if ($product->imagen) {
            $imagenPath = public_path('imagenProductos') . '/' . $product->imagen;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        $product->delete();
        session()->flash('success', '¡El producto se ha eliminado exitosamente!');
        return redirect()->route('tablaProductos');
    }*/

    public function delete($id_producto){
        $product = Product::find($id_producto);

        // Marcamos el producto como "eliminado"
        $product->eliminado = 1;
        $product->save();

        session()->flash('success', '¡El producto se ha eliminado exitosamente!');
        return redirect()->route('tablaProductos');
    }

    public function importarProductos(Request $request){
        $archivoCsv = $request->file('archivo_csv');

        // Validar si se seleccionó un archivo
        if ($archivoCsv == null) {
            return redirect()->route('tablaProductos')->with('error', 'Debe seleccionar un archivo CSV.');
        }

        // Leer el contenido del archivo CSV
        $contenido = file_get_contents($archivoCsv);
        $lineas = explode(PHP_EOL, $contenido);

        // Recorrer las líneas del CSV, comenzando desde la segunda línea (índice 1)
        for ($i = 1; $i < count($lineas); $i++) {
            $datos = str_getcsv($lineas[$i]);

            // Verificar que $datos tenga la cantidad de elementos esperada (al menos 7 elementos)
            if (count($datos) < 7) {
                continue; // Saltar esta línea si no tiene suficientes elementos
            }

            // Validar los campos requeridos en el CSV
            $validator = Validator::make([
                'nombre' => $datos[0],
                'categoria_id' => $datos[1],
                'precio_compra' => $datos[2],
                'precio_venta' => $datos[3],
                'unidades_disponibles' => $datos[4],
                'marca_id' => $datos[5], // Agregamos el campo marca al Validator
                'subcategoria_id' => $datos[6],
            ], [
                'nombre' => 'required|string',
                'categoria_id' => 'required|string',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'unidades_disponibles' => 'required|integer',
                'marca_id' => 'nullable|string', // La marca es obligatoria
                'subcategoria_id' => 'nullable|string', // La subcategoría puede ser nula
            ]);

            if ($validator->fails()) {
                continue; // Saltar esta línea si no cumple con las validaciones
            }

            // Obtener o crear la marca por nombre
            $marca = Marca::where('nombre', $datos[5])->first();

            // Si no se encontró la marca, omitir la creación del producto para esta línea
            if (!$marca) {
                continue;
            }

            // Crear un nuevo registro de Producto con los datos del CSV
            $producto = new Product();
            $producto->nombre = $datos[0];
            $producto->precio_compra = $datos[2];
            $producto->precio_venta = $datos[3];
            $producto->unidades_disponibles = $datos[4];
            

            // Obtener la categoría por código
            $categoria = Categorias::where('codigo', $datos[1])->first();

            // Si no se encontró la categoría, saltamos esta línea
            if (!$categoria) {
                continue;
            }

            // Asignar el usuario actual como creador del producto
            $producto->creado_por = Auth::user()->name;

            // Si se proporcionó el código de subcategoría en el CSV
            if ($datos[6]) {
                // Obtener la subcategoría por código y que pertenezca a la categoría encontrada
                $subcategoria = Subcategoria::where('codigo', $datos[6])
                    ->where('categoria_id', $categoria->id)
                    ->first();

                // Si no se encontró la subcategoría, saltamos esta línea
                if (!$subcategoria) {
                    continue;
                }

                // Asociar la subcategoría al producto
                $producto->subcategoria_id = $subcategoria->id;
            }
            // Asociar la categoría al producto
            $producto->categoria_id = $categoria->id;
            // Asociar la marca al producto
            $producto->marca_id = $marca->id;
            $producto->save();
        }

        return redirect()->route('tablaProductos')->with('success', 'Productos importados exitosamente.');
    }
}
