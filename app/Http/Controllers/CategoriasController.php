<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    public function __construct()
    {
        // Se asegura de que el usuario esté autenticado antes de acceder a las rutas definidas en este controlador
        // El método 'except()' permite especificar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }

    // Método para mostrar la lista de categorías
    public function index()
    {
        // Obtener todas las categorías desde la base de datos
        $categorias = Categorias::where('eliminado', 0)->get();

        // Mostrar la vista 'gestorCategorias' y pasar las categorías como una variable llamada 'categorias'
        return view('categorias.gestorCategorias')->with('categorias', $categorias);
    }

    // Método para redireccionar al formulario de agregar categoría
    public function create()
    {
        // Lógica para mostrar el formulario de creación de una nueva categoría
        return view('categorias.formCategoria');
    }

    // Método para almacenar una nueva categoría en la base de datos
    public function store(Request $request)
    {
        // Validación de los campos enviados en el formulario de creación
        $this->validate($request, [
            'nombre' => 'required|unique:categorias',
            'descripcion' => 'required',
            'codigo' => 'required|numeric|unique:categorias',
            'imagen' => 'required',
        ]);

        // Crear una nueva instancia del modelo Categorias y guardarla en la base de datos
        Categorias::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'codigo' => $request->codigo,
            'imagen'=> $request->imagen,
            'eliminado'=>0,
            'user_id' => auth()->user()->id,
        ]);

        // Redireccionar a la ruta 'categorias' (lista de categorías)
        $request->session()->flash('success', '¡La categoría se ha registrado exitosamente!');
        return redirect()->route('categorias');
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

    // Método para mostrar el formulario de edición de una categoría específica
    public function edit($id)
    {
        // Buscar la categoría por su ID en la base de datos
        $categoria = Categorias::find($id);

        // Mostrar la vista 'editarCategoria' y pasar la categoría encontrada como una variable llamada 'categoria'
        return view('categorias.editarCategoria')->with('categoria', $categoria);
    }

    // Método para actualizar la información de una categoría en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los campos enviados en el formulario de edición
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'codigo' => 'required|numeric|unique:categorias,codigo,' . $id,
        ]);

        // Buscar la categoría por su ID en la base de datos
        $categoria = Categorias::find($id);
        $imagenActual = $categoria->imagen;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $categoria->imagen) {
            // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
            $categoria->imagen = $request->imagen;
        }

        // Actualizar los campos de la categoría con los valores enviados desde el formulario
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->codigo = $request->codigo;
        $categoria->user_id = auth()->user()->id;

        // Guardar los cambios en la base de datos
        $categoria->save();

        // Redireccionar a la ruta 'categorias' (lista de categorías) y mostrar un mensaje de éxito
        $request->session()->flash('success', '¡La categoría se ha editado exitosamente!');
        return redirect()->route('categorias');
    }

    /*
    public function delete($id_categoria)
    {
        // Buscar la categoría por su ID en la base de datos
        $categoria = Categorias::find($id_categoria);
        // Comprobamos si el producto tiene imagen asociada
        if ($categoria->imagen) {
            $imagenPath = public_path('imagenCategoria') . '/' . $categoria->imagen;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }

        // Si la categoría tiene productos relacionados, eliminarlos también
        if ($categoria->productos()->exists()) {
            $productos = $categoria->productos;
            foreach ($productos as $producto) {
                $producto->delete();
            }
        }

        // Si la categoría tiene subcategorías relacionadas, eliminarlas también
        if ($categoria->subcategorias()->exists()) {
            $subcategorias = $categoria->subcategorias;
            foreach ($subcategorias as $subcategoria) {
                $subcategoria->delete();
            }
        }

        // Eliminar la categoría de la base de datos
        $categoria->delete();

        // Redireccionar a la página de lista de categorías (o a otra página de elección) y mostrar un mensaje de éxito
        session()->flash('success', '¡El producto se ha eliminado exitosamente!');
        return redirect()->route('categorias');
    }*/

    public function delete($id_categoria)
    {
        // Buscar la categoría por su ID en la base de datos
        $marca = Categorias::find($id_categoria);

        if ($categoria->productos()->exists()) {
            $productos = $categoria->productos;
            foreach ($productos as $producto) {
                $producto->eliminado = 1;
                $producto->save();
            }
        }
        // Si la categoría tiene subcategorías relacionadas, eliminarlas realmente de la base de datos
        if ($categoria->subcategorias()->exists()) {
            $subcategorias = $categoria->subcategorias;
            foreach ($subcategorias as $subcategoria) {
                $subcategoria->delete();
            }
        }

        // Marcamos la categoría como "eliminada" y actualizamos el campo en la base de datos
        $categoria->eliminado = 1;
        $categoria->save();

        // Redireccionar a la página de lista de categorías (o a otra página de elección) y mostrar un mensaje de éxito
        session()->flash('success', '¡La categoría se ha eliminado exitosamente!');
        //return redirect()->route('categorias');
    }
}
