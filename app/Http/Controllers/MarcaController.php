<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.tablaMarcas', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.gestormarcas');
    }

    public function store(Request $request)
    {       
        $request->validate([
            'nombre'  => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
        ]);
        
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->imagen = $request->imagen;
        $marca->creado_por = auth()->user()->id; 
        $marca->save();
        return redirect()->route('marcas');
    }
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.tablaMarcas', compact('marca'));
    }

    public function edit($id)
    {
        $marca = Marca::find($id);
        return view('marcas.editarMarca', compact('marca'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
        ]);

        $marca = Marca::find($id);

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->imagen = $request->imagen;
        
        $marca->save();
        
        return redirect()->route('marcas');
    }

    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas');
    }
}
