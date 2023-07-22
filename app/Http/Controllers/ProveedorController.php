<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.tablaProveedores', compact('proveedores'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.gestorProveedores', compact('proveedores'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:proveedores',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
        ]);

        Proveedor::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'fotografia' => $request->imagen,
        ]);
        $request->session()->flash('success', '¡El Proveedor se ha registrado exitosamente!');

        return redirect()->route('proveedores');
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
        $imagenPath = public_path('imagenProveedor'). '/'. $nombreImagen;
    
        //Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        
    
        //verificamos que el nombre del archivo se ponga como único
        return response()->json(['imagen'=>$nombreImagen]);
    
    }


    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('auth.proveedores.verProveedor', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.editarProveedores', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
        ]);

        $proveedor = Proveedor::find($id);
        $imagenActual = $proveedor->fotografia;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $proveedor->fotografia) {
            // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
            $proveedor->fotografia = $request->imagen;
        }
        $proveedor->nombre = $request->nombre;
        $proveedor->codigo = $request->codigo;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        // Guardar los cambios en la base de datos
        $proveedor->save();

        if ($proveedor->wasChanged()) {
            $request->session()->flash('success', '¡El proveedor se ha editado exitosamente!');
        }




        return redirect()->route('proveedores');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores');
    }
}