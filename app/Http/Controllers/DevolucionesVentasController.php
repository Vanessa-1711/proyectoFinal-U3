<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Models\DevolucionVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
=======

use Illuminate\Http\Request;
>>>>>>> 14c153504f08feed363f63b5ff88474d33396fb7

class DevolucionesVentasController extends Controller
{
    //
<<<<<<< HEAD
    public function index()
    {
        $devoluciones = DevolucionVenta::all();

        return view('devoluciones.tablaDevoluciones', compact('devoluciones'));
    }

    public function create()
    {
        return view('devoluciones.gestorDevoluciones');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_producto' => 'required',
            'fecha_devolucion' => 'required',
            'cliente' => 'required',
            'estatus' => 'required',
            'total_pagado' => 'required',
            'adeudo' => 'required',
            'estatus_pago' => 'required',
            'imagen' => 'required'
        ]);

        DevolucionVenta::create($data);

        return redirect()->route('devoluciones')->with('mensaje', 'Devolución creada exitosamente');
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
        $imagenPath = public_path('imagenDevolucion'). '/'. $nombreImagen;
    
        //Pasamos la imagen de memoria al servidor
        $imagenServidor->save($imagenPath);
        
    
        //verificamos que el nombre del archivo se ponga como único
        return response()->json(['imagen'=>$nombreImagen]);
    
    }

    public function show(DevolucionVenta $devolucion)
    {
        return view('devoluciones.show', compact('devolucion'));
    }

    public function edit(DevolucionVenta $devolucion)
    {
        return view('devoluciones.edit', compact('devolucion'));
    }

    public function update(Request $request, DevolucionVenta $devolucion)
    {
        $data = $request->validate([
            'nombre_producto' => 'required',
            'fecha_devolucion' => 'required',
            'cliente' => 'required',
            'estatus' => 'required',
            'total_pagado' => 'required',
            'adeudo' => 'required',
            'estatus_pago' => 'required',
            'imagen' => 'required'
        ]);

        $devolucion->update($data);

        return redirect()->route('devoluciones.index')->with('mensaje', 'Devolución actualizada exitosamente');
    }

    public function destroy(DevolucionVenta $devolucion)
    {
        $devolucion->delete();

        return redirect()->route('devoluciones.index')->with('mensaje', 'Devolución eliminada exitosamente');
    }
=======
>>>>>>> 14c153504f08feed363f63b5ff88474d33396fb7
}
