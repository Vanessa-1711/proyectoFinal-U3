<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


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
        $request->session()->flash('success', '¡La marca se ha registrado exitosamente!');
        return redirect()->route('marcas');
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
        $imagenPath = public_path('imagenMarcas'). '/'. $nombreImagen;
    
        //Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        
    
        //verificamos que el nombre del archivo se ponga como único
        return response()->json(['imagen'=>$nombreImagen]);
    
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
        $imagenActual = $marca->imagen;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $marca->imagen) {
            // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
            $marca->imagen = $request->imagen;
        }

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        
        $marca->save();
        if ($marca->wasChanged()) {
            $request->session()->flash('success', '¡La marca se ha editado exitosamente!');
        }
        
        return redirect()->route('marcas');
    }

    public function delete($id_marca)
    {
        $marca = Marca::find($id_marca);
        if ($marca->productos()->exists()) {
            // Obtener las facturas relacionadas
            $productos = $marca->productos;
             // Eliminar las facturas relacionadas
             foreach ($productos as $productos) {
                $productos->delete();
            }
        }
        $marca->delete();
        session()->flash('success', '¡El producto se ha eliminado exitosamente!');
        return redirect()->route('marcas');
    }
}
