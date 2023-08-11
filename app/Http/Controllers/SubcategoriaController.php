<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Models\Categorias;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SubcategoriaController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar que el usuario esté autenticado
        // except() se utiliza para indicar qué métodos pueden ser accesibles sin autenticación
        $this->middleware('auth');
    }

    //Muestra una tabla con todas las subcategorías registradas.
    public function index()
    {
        $subcategorias = Subcategoria::all();
        return view('subcategoria.tablaSubcategoria', compact('subcategorias'));
    }

    //Muestra el formulario para crear una nueva subcategoría.
    public function create()
    {
        $categorias = Categorias::all();
        // Verificar si se encontraron categorías
        if ($categorias->isEmpty()) {
            // No se encontraron categorías, crear un mensaje de alerta y redirigir al usuario
            session()->flash('info', 'Es necesario tener categorias registradas.');
            return redirect('/subcategorias');
        }

        return view('subcategoria.gestorSubcategoria', compact('categorias'));
    }
    // Método para almacenar la imagen de un producto usando Intervention Image
    public function Imagenstore(Request $request){
        // Identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        // Generar un ID único para cada una de las imágenes que se cargan al servidor
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Implementar Intervention Image
        $imagenServidor = Image::make($imagen);

        // Agregar efectos de Intervention Image: Indicar la medida de cada imagen 
        $imagenServidor->fit(1000, 1000);

        // Movemos la imagen a un lugar físico del servidor
        $imagenPath = public_path('imagenSubcategoria') . '/' . $nombreImagen;

        // Pasar la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);

        // Verificar que el nombre del archivo se ponga como único
        return response()->json(['imagen' => $nombreImagen]);
    }

    //Almacena una nueva subcategoría en la base de datos.
    public function store(Request $request)
    {
        // Validar los campos del formulario antes de almacenar la subcategoría
        $this->validate($request, [
            
            'categoria_id' => 'required',
            'nombre' => 'required',
            'imagen'=> 'required',
            'codigo' => 'required|numeric|unique:subcategorias',
            'descripcion' => 'required',
        ]);

        // Crear una nueva instancia del modelo Subcategoria y asignar los valores del formulario
        $subcategoria = new Subcategoria;
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->imagen = $request->imagen;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();

        // Mostrar un mensaje de éxito y redireccionar a la página de subcategorías
        session()->flash('success', '¡La subcategoría se ha registrado exitosamente!');
        return redirect('/subcategorias');
    }

    //Muestra el formulario para editar una subcategoría existente.
    public function edit($id)
    {
        // Buscar la subcategoría con el ID proporcionado
        $subcategoria = Subcategoria::find($id);
        $categorias = Categorias::all();
        return view('subcategoria.editarSubcategoria', compact('subcategoria', 'categorias'));
    }

    //Actualiza una subcategoría existente en la base de datos.
    public function update(Request $request, $id)
    {
        // Validar los campos del formulario antes de actualizar la subcategoría
        $this->validate($request, [

            'categoria_id' => 'required',
            'nombre' => 'required',
            'codigo' => 'required|min:5|numeric',
            'descripcion' => 'required',
            'imagen'=> 'required',
            
        ]);
        

        // Buscar la subcategoría por el ID
        $subcategoria = Subcategoria::findOrFail($id);

        $imagenActual = $subcategoria->imagen;

        // Verificar si el valor del campo de imagen ha cambiado
        if ($request->imagen !== $subcategoria->imagen) {
            // Actualizar la propiedad 'imagen' del modelo con el nuevo valor
            $subcategoria->imagen = $request->imagen;
        }


        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->codigo = $request->codigo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->user_id = auth()->user()->id;
        $subcategoria->save();

        // Establecer el mensaje de éxito solo si la subcategoría se edita correctamente
        if ($subcategoria->wasChanged()) {
            $request->session()->flash('success', '¡La subcategoría se ha editado exitosamente!');
        }

        return redirect('/subcategorias');
    }

    //Elimina una subcategoría específica de la base de datos.
    public function delete($id_subcategoria)
    {
        // Buscar la subcategoría por el ID
        $subcategoria = Subcategoria::find($id_subcategoria);
        
        // Verificar si la subcategoría tiene productos relacionados
        if ($subcategoria->productos()->exists()) {
            // Obtener los productos relacionados con la subcategoría
            $productos = $subcategoria->productos;
            
            // Eliminar los productos relacionados
            foreach ($productos as $producto) {
                $producto->delete();
            }
        }

        // Eliminar la subcategoría
        $subcategoria->delete();

        // Mostrar un mensaje de éxito y redireccionar a la página de subcategorías
        session()->flash('success', '¡La subcategoría se ha eliminado exitosamente!');
        return redirect('/subcategorias');
    }
}
