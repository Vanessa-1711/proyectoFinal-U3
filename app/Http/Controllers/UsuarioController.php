<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UsuarioController extends Controller
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
       
        $usuarios = Usuario::all();
        return view('usuarios.tabla', compact('usuarios'));
    }

    //Muestra el formulario para crear un nuevo proveedor.
    public function create()
    {
        $usuarios = Usuario::all();
        return view('usuarios.crear');
    }
    
    //Almacena un nuevo proveedor en la base de datos.
    public function store(Request $request)
    {
        // Validar los campos del formulario antes de almacenar el proveedor
        $this->validate($request, [
            'imagen' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email',
            'password' => 'required',
            'estado' => 'required',
            'rol' => 'required',
            'username' => 'required',
        ]);

        // Crear una nueva instancia del modelo Proveedor y asignar los valores del formulario
        Usuario::create([
            'name' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->correo,
            'imagen' => $request->imagen,
            'password' => $request->password,
            'status' => $request->estado,
            'rol' => $request->rol,
            'username' => $request->username,
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
        $imagenPath = public_path('imagenUsuario') . '/' . $nombreImagen;

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
        $usuario = Usuario::find($id);
        return view('usuarios.editar', compact('usuario'));
    }

    //Actualiza un proveedor existente en la base de datos.
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar el proveedor
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'correo' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'estado' => 'required',
            'rol' => 'required',
            'username' => 'required',
        ]);

        // Buscar el proveedor por el ID
        $usuario = Usuario::find($id);
        $imagenActual = $usuario->imagen;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $usuario->imagen) {
            // Actualizar la propiedad 'fotografia' del modelo con el nuevo valor
            $usuario->imagen = $request->imagen;
        }
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->codigo;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->correo;
        $usuario->password = $request->password;
        $usuario->status = $request->estado;
        $usuario->rol = $request->rol;
        $usuario->username = $request->username;

        // Guardar los cambios en la base de datos
        $usuario->save();

        // Establecer el mensaje de éxito solo si el usuario se edita correctamente
        if ($usuario->wasChanged()) {
            $request->session()->flash('success', '¡El proveedor se ha editado exitosamente!');
        }

        return redirect()->route('usuario.index');
    }

    //Elimina un proveedor específico de la base de datos.
    public function destroy(Usuario $usuario)
    {
        // Comprobamos si el producto tiene imagen asociada
        if ($usuario->fotografia) {
            $imagenPath = public_path('imagenUsuario') . '/' . $usuario->imagen;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        // Eliminar el proveedor
        $usuario->delete();
        session()->flash('success', '¡El proveedor se ha eliminado exitosamente!');
        return redirect()->route('proveedores');
    }
}
