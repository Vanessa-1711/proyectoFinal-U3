<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Country;
use App\Models\State;
class ProveedorController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar que el usuario esté autenticado
        // except() se utiliza para indicar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }

    //Muestra una tabla con todos los proveedores registrados.
    public function index()
    {
       
        $proveedores = Proveedor::all();
        return view('proveedores.tablaProveedores', compact('proveedores'));
    }

    //Muestra el formulario para crear un nuevo proveedor.
    public function create()
    {
        $proveedores = Proveedor::all();
        $countries = Country::all();
        // $cities = City::all();
        $states = State::all();

        return view('proveedores.gestorProveedores', compact('proveedores','countries', 'states'));
    }
    
    //Almacena un nuevo proveedor en la base de datos.
    public function store(Request $request)
    {
        // Validar los campos del formulario antes de almacenar el proveedor
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric|unique:proveedores',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'sometimes',
        ]);

        // Crear una nueva instancia del modelo Proveedor y asignar los valores del formulario
        Proveedor::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'fotografia' => $request->fotografia,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'ciudad' => $request->ciudad,
        ]);

        // Mostrar un mensaje de éxito y redireccionar a la página de proveedores
        $request->session()->flash('success', '¡El Proveedor se ha registrado exitosamente!');
        return redirect()->route('proveedores');
    }

     //Método para almacenar la imagen de un proveedor usando Intervention Image.
    public function Imagenstore(Request $request)
    {
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

    //Muestra los detalles de un proveedor específico.
    public function show($id)
    {
        // Buscar el proveedor con el ID proporcionado
        $proveedor = Proveedor::findOrFail($id);
        return view('auth.proveedores.verProveedor', compact('proveedor'));
    }

    //Muestra el formulario para editar un proveedor existente.
    public function edit($id)
    {
        // Buscar el proveedor con el ID proporcionado
        $proveedor = Proveedor::find($id);
        $countries = Country::all();
        $states = State::all();
        return view('proveedores.editarProveedores', compact('proveedor', 'countries', 'states'));
    }

    //Actualiza un proveedor existente en la base de datos.
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar el proveedor
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'sometimes',
        ]);

        // Buscar el proveedor por el ID
        $proveedor = Proveedor::find($id);
        $imagenActual = $proveedor->fotografia;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $proveedor->fotografia) {
            // Actualizar la propiedad 'fotografia' del modelo con el nuevo valor
            $proveedor->fotografia = $request->imagen;
        }
        $proveedor->nombre = $request->nombre;
        $proveedor->codigo = $request->codigo;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->pais = $request->pais;
        $proveedor->estado = $request->estado;
        $proveedor->ciudad = $request->ciudad;
        
        // Guardar los cambios en la base de datos
        $proveedor->save();

        // Establecer el mensaje de éxito solo si el proveedor se edita correctamente
        if ($proveedor->wasChanged()) {
            $request->session()->flash('success', '¡El proveedor se ha editado exitosamente!');
        }

        return redirect()->route('proveedores');
    }

    //Elimina un proveedor específico de la base de datos.
    public function destroy(Proveedor $proveedor)
    {
        // Comprobamos si el producto tiene imagen asociada
        if ($proveedor->fotografia) {
            $imagenPath = public_path('imagenProveedor') . '/' . $proveedor->fotografia;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        // Eliminar el proveedor
        $proveedor->delete();
        session()->flash('success', '¡El proveedor se ha eliminado exitosamente!');
        return redirect()->route('proveedores');
    }
}
