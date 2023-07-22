<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.tablaClientes', compact('clientes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('clientes.getorClientes', compact('clientes'));
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
        $imagenPath = public_path('imagenCliente'). '/'. $nombreImagen;
    
        //Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        
    
        //verificamos que el nombre del archivo se ponga como único
        return response()->json(['imagen'=>$nombreImagen]);
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:clientes',
            'empresa' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->fotografia = $request->imagen;
        $cliente->save();
        $request->session()->flash('success', '¡El cliete se ha registrado exitosamente!');
        return redirect()->route('clientes');
    }


    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.verCliente', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $imagen_url = asset('imagesCliente/' . $cliente->fotografia);
        return view('clientes.editarClientes', compact('cliente', 'imagen_url'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:clientes',
            'empresa' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
        ]);
        $cliente = Cliente::find($id);
        // Obtener el nombre de la imagen actual del producto
        $imagenActual = $cliente->fotografia;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $cliente->fotografia) {
            // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
            $cliente->fotografia = $request->imagen;
        }
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;

        // Guardar los cambios en la base de datos
        $cliente->save();

        if ($cliente->wasChanged()) {
            $request->session()->flash('success', '¡El cliete se ha editado exitosamente!');
        }
        return redirect()->route('clientes');
}



    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes');
    }
}