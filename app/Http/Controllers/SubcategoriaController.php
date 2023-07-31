<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Models\Categorias;

class SubcategoriaController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar que el usuario esté autenticado
        // except() se utiliza para indicar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }

    //Muestra una tabla con todas las subcategorías registradas.
    public function index()
    {
        $subcategorias = Subcategoria::all();
        return view('subcategoria.tablaSubcategoria', compact('subcategorias'));
    }

    //Muestra el formulario para crear una nueva subcategoría.
    public function create()
    {
        $categorias = Categorias::all();
        return view('subcategoria.gestorSubcategoria', compact('categorias'));
    }

    //Almacena una nueva subcategoría en la base de datos.
    public function store(Request $request)
    {
        // Validar los campos del formulario antes de almacenar la subcategoría
        $this->validate($request, [
            'nombre' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'descripcion' => 'required',
        ]);

        // Crear una nueva instancia del modelo Subcategoria y asignar los valores del formulario
        $subcategoria = new Subcategoria;
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();

        // Mostrar un mensaje de éxito y redireccionar a la página de subcategorías
        session()->flash('success', '¡La subcategoría se ha registrado exitosamente!');
        return redirect('/subcategorias');
    }

    //Muestra el formulario para editar una subcategoría existente.
    public function edit($id)
    {
        // Buscar la subcategoría con el ID proporcionado
        $subcategoria = Subcategoria::find($id);
        $categorias = Categorias::all();
        return view('subcategoria.editarSubcategoria', compact('subcategoria', 'categorias'));
    }

    //Actualiza una subcategoría existente en la base de datos.
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar la subcategoría
        $this->validate($request, [
            'nombre' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'descripcion' => 'required',
        ]);

        // Buscar la subcategoría por el ID
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();

        // Establecer el mensaje de éxito solo si la subcategoría se edita correctamente
        if ($subcategoria->wasChanged()) {
            $request->session()->flash('success', '¡La subcategoría se ha editado exitosamente!');
        }

        return redirect('/subcategorias');
    }

    //Elimina una subcategoría específica de la base de datos.
    public function delete($id_subcategoria)
    {
        // Buscar la subcategoría por el ID
        $subcategoria = Subcategoria::find($id_subcategoria);
        
        // Verificar si la subcategoría tiene productos relacionados
        if ($subcategoria->productos()->exists()) {
            // Obtener los productos relacionados con la subcategoría
            $productos = $subcategoria->productos;
            
            // Eliminar los productos relacionados
            foreach ($productos as $producto) {
                $producto->delete();
            }
        }

        // Eliminar la subcategoría
        $subcategoria->delete();

        // Mostrar un mensaje de éxito y redireccionar a la página de subcategorías
        session()->flash('success', '¡La subcategoría se ha eliminado exitosamente!');
        return redirect('/subcategorias');
    }
}
