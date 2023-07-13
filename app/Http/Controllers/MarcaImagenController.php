<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MarcaImagenController extends Controller
{
    public function store(Request $request)
    {
        // Identificar el archivo que se sube a dropzone
        $imagen = $request->file('file');

        // Generar un ID único para cada una de las imágenes que se cargan al servidor
        $nombreImagen = Str::uuid().".". $imagen->extension();

        // Implementar Intervention Image
        $imagenServidor = Image::make($imagen);
        
        // Agregamos efectos
        $imagenServidor->fit(1000,1000);

        // Movemos la imagen a un lugar físico del servidor
        $imagenPath = public_path('images') . '/' . $nombreImagen;

        // Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);

        // Verificamos el nombre del archivo se ponga como unique
        return response()->json(['imagen' => $nombreImagen]);
    }
}
