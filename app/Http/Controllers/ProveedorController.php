<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.tablaProveedores', compact('proveedores'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.gestorProveedores', compact('proveedores'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
        ]);

        Proveedor::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'fotografia' => $request->imagen,
        ]);

        return redirect()->route('proveedores');
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('auth.proveedores.verProveedor', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        $imagen_url = asset('imagesProveedor/' . $proveedor->fotografia);
        return view('auth.proveedores.editarProveedores', compact('proveedor', 'imagen_url'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
        ]);

        // Actualización de datos
        if($request->hasFile('fotografia')){
            $imageName = time().'.'.$request->fotografia->extension();  
            $request->fotografia->move(public_path('imagesProveedor'), $imageName);
        } else {
            $imageName = Proveedor::find($id)->fotografia;
        }

        Proveedor::where('id', $id)->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'fotografia' => $imageName
        ]);

        return redirect()->route('proveedores');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores');
    }
}