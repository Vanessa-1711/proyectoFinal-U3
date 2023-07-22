<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Models\Categorias;

class SubcategoriaController extends Controller
{
    // ...
    public function index()
    {
        $subcategorias = Subcategoria::all();
        return view('subcategoria.tablaSubcategoria', compact('subcategorias'));
    }

    public function create()
    {
        $categorias = Categorias::all();
        return view('subcategoria.gestorSubcategoria', compact('categorias'));
        
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            //Reglas de validacion 
            'nombre' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'descripcion' =>'required',
        ]);
        $subcategoria = new Subcategoria;
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();
        
        // ...
        session()->flash('success', '¡La subcategoria se ha registrado exitosamente!');
        return redirect('/subcategorias');
    }

    // ...
    public function edit($id)
    {
        $subcategoria = Subcategoria::find($id);
        $categorias = Categorias::all();
        return view('subcategoria.editarSubcategoria', compact('subcategoria', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            //Reglas de validacion 
            'nombre' => 'required',
            'categoria_id' => 'required',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'descripcion' =>'required',
        ]);

        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();
        if ($subcategoria->wasChanged()) {
            $request->session()->flash('success', '¡La subcategoria se ha editado exitosamente!');
        }

        return redirect('/subcategorias');
    }

    public function delete($id_subcategoria)
    {
        $subcategoria = Subcategoria::find($id_subcategoria);
        if ($subcategoria->productos()->exists()) {
            // Obtener las facturas relacionadas
            $subcategorias = $subcategoria->productos;
             // Eliminar las facturas relacionadas
             foreach ($subcategorias as $subcategorias) {
                $subcategorias->delete();
            }
        }

        $subcategoria->delete();

        session()->flash('success', '¡La subcategoria se ha eliminado exitosamente!');
        return redirect('/subcategorias');
    }

}
