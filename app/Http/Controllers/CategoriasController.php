<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

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
        $categorias = Categorias::all();

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
            'codigo' => 'required|unique:categorias',
        ]);

        // Crear una nueva instancia del modelo Categorias y guardarla en la base de datos
        Categorias::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'codigo' => $request->codigo,
            'user_id' => auth()->user()->id,
        ]);

        // Redireccionar a la ruta 'categorias' (lista de categorías)
        $request->session()->flash('success', '¡La categoría se ha registrado exitosamente!');
        return redirect()->route('categorias');
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
            'codigo' => 'required|min:5|numeric|unique:categorias',
        ]);

        // Buscar la categoría por su ID en la base de datos
        $categoria = Categorias::find($id);

        // Si la categoría no se encuentra, redireccionar y mostrar un mensaje de error
        if (!$categoria) {
            return redirect()->back()->with('error', 'Categoría no encontrada');
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

    // Método para eliminar una categoría de la base de datos
    public function delete($id_categoria)
    {
        // Buscar la categoría por su ID en la base de datos
        $categoria = Categorias::find($id_categoria);

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
    }
}
