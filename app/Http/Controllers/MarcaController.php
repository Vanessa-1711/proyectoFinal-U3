<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class MarcaController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar que el usuario esté autenticado
        $this->middleware('auth');
    }

    // Método para mostrar todas las marcas en una tabla
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.tablaMarcas', compact('marcas'));
    }

    // Método para mostrar el formulario para crear una nueva marca
    public function create()
    {
        return view('marcas.gestormarcas');
    }

    // Método para almacenar una nueva marca en la base de datos
    public function store(Request $request)
    {       
        // Validar los campos del formulario antes de almacenar la marca
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
        ]);
        
        // Crear una nueva instancia del modelo Marca y asignar los valores del formulario
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->imagen = $request->imagen;
        $marca->creado_por = auth()->user()->id; // Asignar el ID del usuario autenticado como creador de la marca
        $marca->save();
        
        // Mostrar un mensaje de éxito y redireccionar a la página de la tabla de marcas
        $request->session()->flash('success', '¡La marca se ha registrado exitosamente!');
        return redirect()->route('marcas');
    }

    // Método para almacenar la imagen de una marca usando Intervention Image
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
        $imagenPath = public_path('imagenMarcas') . '/' . $nombreImagen;

        // Pasar la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);

        // Verificar que el nombre del archivo se ponga como único
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Método para mostrar los detalles de una marca específica
    public function show($id)
    {
        // Buscar la marca con el ID proporcionado
        $marca = Marca::findOrFail($id);
        return view('marcas.tablaMarcas', compact('marca'));
    }

    // Método para mostrar el formulario para editar una marca existente
    public function edit($id)
    {
        // Buscar la marca con el ID proporcionado
        $marca = Marca::find($id);
        return view('marcas.editarMarca', compact('marca'));
    }

    // Método para actualizar una marca existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar la marca
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required',
            'descripcion' => 'required',
        ]);

        // Buscar la marca con el ID proporcionado
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

        // Verificar si la marca ha sido editada exitosamente y mostrar mensaje de éxito
        if ($marca->wasChanged()) {
            $request->session()->flash('success', '¡La marca se ha editado exitosamente!');
        }

        return redirect()->route('marcas');
    }

    // Método para eliminar una marca y sus productos relacionados
    public function delete($id_marca)
    {
        // Buscar la marca con el ID proporcionado
        $marca = Marca::find($id_marca);

        // Verificar si la marca tiene productos relacionados
        if ($marca->productos()->exists()) {
            // Obtener los productos relacionados
            $productos = $marca->productos;
            
            // Eliminar los productos relacionados
            foreach ($productos as $producto) {
                $producto->delete();
            }
        }

        // Eliminar la marca
        $marca->delete();

        // Mostrar mensaje de éxito y redireccionar a la página de la tabla de marcas
        session()->flash('success', '¡La marca se ha eliminado exitosamente!');
        return redirect()->route('marcas');
    }
}
