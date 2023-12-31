<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class ImportarController extends Controller
{
    //Constructor para validar usuario autentificado
    public function __construct()
    {
        // Para verificar que el user este autenticado
        // except() es para indicar cuales metodos pueden usarse sin autenticarse
        $this->middleware('auth');
    }
    //Funcion para retornar la vista de importar productos
    public function index()
    {
        return view('productos.importarProductos');
    }


    public function store(Request $request)
    {
        // Validar que el archivo esté presente
        $request->validate([
            'csv-file' => 'required|file|mimes:csv,txt' // Asegurarse de que sea un archivo CSV o TXT
        ]);

        // Leer el archivo
        $path = $request->file('csv-file')->getRealPath();
        $csvData = file_get_contents($path);

        // Convertir el CSV a un array
        $lines = explode("\n", $csvData);
        $arrayData = [];
        foreach ($lines as $line) {
            $arrayData[] = str_getcsv($line);
        }

        // Validar la estructura del encabezado
        $expectedHeader = ['nombre', 'categoria_id', 'marca_id', 'codigo', 'stock', 'precio_venta', 'precio_compra'];
        if ($arrayData[0] !== $expectedHeader) {
            return back()->with('error', 'La estructura del CSV no coincide con el formato esperado.');
        }
        $registros_erroneos = 0;
        // Procesar los datos y guardar en la base de datos
        foreach ($arrayData as $index => $data) {
            if ($index == 0)
                continue; // Ignorar el encabezado

            // Si no hay al menos 7 columnas, continuar con la siguiente línea
            if (count($data) < 7) {
                continue;
            }

            // Validar que la categoría y marca existen en la base de datos
            if (!empty($data[1]) && !empty($data[2]) && Categorias::find($data[1]) && Marca::find($data[2])) {
                Product::create([
                    'nombre' => $data[0],
                    'categoria_id' => $data[1],
                    'marca_id' => $data[2],
                    'precio_compra' => $data[6],
                    'precio_venta' => $data[5],
                    'unidades_disponibles' => $data[4],
                    'creado_por' => auth()->user()->username,
                ]);
            } else {
                $registros_erroneos++;
                // Puedes registrar un log o enviar un mensaje si alguna de las relaciones no existe
                // Por ejemplo: Log::warning("No se encontró relación para el producto: " . $data[0]);
            }
        }

        // Redireccionar o enviar una respuesta
        return back()->with('success', 'Datos importados con éxito. Hubo '.$registros_erroneos.' errores en la importacion');
    }
}