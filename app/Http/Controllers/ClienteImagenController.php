<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteImagenController extends Controller
{
    //Almacenamiento de imagen
    public function store(Request $request){
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
        $imagenPath = public_path('imagenClientes'). '/'. $nombreImagen;

        //Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        

        //verificamos que el nombre del archivo se ponga como único
        return response()->json(['imagen'=>$nombreImagen]);

    }
}
