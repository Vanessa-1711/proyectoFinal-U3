<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriasController extends Controller
{
    //
    public function index(){
        // Mostrar la vista de login de usuarios
        $categorias = categorias::all();
        return view('categorias.gestorCategorias')->with('categorias', $categorias);
    }

    //Funcion para redireccionar al formulario de agregar categoria
    public function create()
    {
        // Lógica para mostrar el formulario de creación de una nueva empresa
        return view('categorias.formCategoria');
    }

    public function store(Request $request){
        $this->validate($request,[
            //Reglas de validacion 
            'nombre' => 'required|unique:categorias',
            'descripcion' => 'required',
            'codigo' => 'required|unique:categorias',
        ]);
        Categorias::create([
            'nombre'=> $request->nombre,
            'descripcion'=>$request->descripcion,
            'codigo'=> $request->codigo,
            'user_id' => auth()->user()->id,
        ]);
        //Redireccionando a dashboard
        $categorias = categorias::all();
        $request->session()->flash('success', '¡La categoría se ha registrado exitosamente!');
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return redirect()->route('categorias');
    }
    public function edit($id)
    {
        $categoria = Categorias::find($id);
        return view('categorias.editarCategoria')->with('categoria', $categoria);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // Reglas de validación para los campos actualizados
            'nombre' => 'required',
            'descripcion' => 'required',
            'codigo' => 'required',
        ]);

       // Actualización de datos
        $categoria = Categorias::find($id); // Buscar la categoría por el ID
        if (!$categoria) {
            // Si no se encuentra la categoría, redireccionar o mostrar un error
            return redirect()->back()->with('error', 'Categoría no encontrada');
        }

        // Actualizar los campos de la categoría
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->codigo = $request->codigo;
        $categoria->user_id = auth()->user()->id;

        // Guardar los cambios en la base de datos
        $categoria->save();

        // Redireccionar a la ruta 'categorias'
        $request->session()->flash('success', '¡La categoría se ha editado exitosamente!');
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return redirect()->route('categorias');
    }
    public function delete($id_categoria)
    {
        
        /// Buscar la empresa emisora por su ID
        $categoria = Categorias::find($id_categoria);
        if ($categoria->productos()->exists()) {
            // Obtener las facturas relacionadas
            $productos = $categoria->productos;
             // Eliminar las facturas relacionadas
             foreach ($productos as $productos) {
                $productos->delete();
            }
        }
        if ($categoria->subcategorias()->exists()) {
            // Obtener las facturas relacionadas
            $subcategorias = $categoria->subcategorias;
             // Eliminar las facturas relacionadas
             foreach ($subcategorias as $subcategorias) {
                $subcategorias->delete();
            }
        }


        // Eliminar la empresa emisora
        $categoria->delete();

        // Redireccionar a la página de lista de categorías o a otra página de tu elección
        return redirect()->route('categorias')->with('mensaje', 'Categoría eliminada exitosamente');
    }
}
