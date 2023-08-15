<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
class ClienteController extends Controller
{
    public function __construct()
    {
        // Se asegura de que el usuario esté autenticado antes de acceder a las rutas definidas en este controlador
        // El método 'except()' permite especificar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }

    // Método para mostrar la lista de clientes
    public function index()
    {
        // Obtener todos los clientes desde la base de datos
        $clientes = Cliente::all();

        // Mostrar la vista 'tablaClientes' y pasar los clientes como una variable llamada 'clientes'
        return view('clientes.tablaClientes', compact('clientes'));
    }

    // Método para mostrar el formulario de creación de cliente
    public function create()
    {
        // Obtener todos los clientes desde la base de datos (esto parece innecesario aquí)
        $clientes = Cliente::all();
        // $cities = City::all();
        $countries = Country::all();
        $states = State::all();

        // Mostrar la vista 'getorClientes' y pasar los clientes como una variable llamada 'clientes'
        return view('clientes.getorClientes', compact('clientes','countries', 'states' ));
    }

    // Método para almacenar la imagen del cliente en el servidor
    public function Imagenstore(Request $request)
    {
        // Identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');
        
        // Generar un ID único para cada una de las imágenes que se cargan en el servidor
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
        // Implementar Intervention Image para manipular la imagen
        $imagenServidor = Image::make($imagen);
        
        // Agregamos efectos de Intervention Image: Indicamos la medida de cada imagen
        $imagenServidor->fit(1000, 1000);
        
        // Movemos la imagen a una ubicación física en el servidor
        $imagenPath = public_path('imagenCliente') . '/' . $nombreImagen;
        
        // Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        
        // Verificamos que el nombre del archivo se ponga como único y lo devolvemos como respuesta
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Método para almacenar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        //Verifica si todos los campos se llenaron correctamente
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:clientes',
            'empresa' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
            'pais' => 'required',
            'ciudad' => 'sometimes',
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear una nueva instancia del modelo Cliente y guardarla en la base de datos
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->pais = $request->pais;
        $cliente->estado = $request->estado;
        $cliente->ciudad = $request->input('ciudad');
        $cliente->fotografia = $request->fotografia; // Aquí asumo que la imagen es una cadena con el nombre de la imagen en el servidor
        $cliente->save();

        // Redireccionar a la ruta 'clientes' (lista de clientes) y mostrar un mensaje de éxito
        $request->session()->flash('success', '¡El cliente se ha registrado exitosamente!');
        return redirect()->route('clientes');
    }


    // Método para mostrar la vista de detalles de un cliente
    public function show($id)
    {
        // Buscar el cliente en la base de datos por su identificador único ($id)
        $cliente = Cliente::findOrFail($id);
        // Devolver la vista 'clientes.verCliente' y pasar el cliente encontrado como dato
        return view('clientes.verCliente', compact('cliente'));
    }

    // Método para mostrar la vista de edición de un cliente
    public function edit($id)
    {
        // Buscar el cliente en la base de datos por su identificador único ($id)
        $cliente = Cliente::find($id);
        // Devolver la vista 'clientes.editarClientes' y pasar el cliente encontrado como dato
        return view('clientes.editarClientes', compact('cliente'));
    }

    //Metodo para actualizar los datos del cliente
    public function update(Request $request, $id)
    {
        //Validacion
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:clientes',
            'empresa' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
        ]);
        
        // Obtener el cliente por su ID en la base de datos
        $cliente = Cliente::find($id);

        // Obtener el nombre de la imagen actual del cliente
        $imagenActual = $cliente->fotografia;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $cliente->fotografia) {
            // Actualizar la propiedad 'fotografia' del modelo con el nuevo valor
            $cliente->fotografia = $request->imagen;
        }

        // Actualizar los demás campos del cliente con los valores enviados desde el formulario
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;

        // Guardar los cambios en la base de datos
        $cliente->save();

        if ($cliente->wasChanged()) {
            $request->session()->flash('success', '¡El cliente se ha editado exitosamente!');
        }

        // Redireccionar a la ruta 'clientes' (lista de clientes)
        return redirect()->route('clientes');
    }

    // Método para eliminar un cliente de la base de datos
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        // Comprobamos si el producto tiene imagen asociada
        if ($cliente->fotografia) {
            $imagenPath = public_path('imagenCliente') . '/' . $cliente->fotografia;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        session()->flash('success', '¡El cliente se ha eliminado exitosamente!');
        return redirect()->route('clientes');
    }

    public function getStatesByCountry(Request $request) {
        $countryId = $request->get('countryid');
        
        $states = State::where('countryid', $countryId)->get();
    
        return response()->json($states);
    }
}
