<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.tablaClientes', compact('clientes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('clientes.getorClientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'empresa' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->fotografia = $request->imagen;
        $cliente->save();

        return redirect()->route('clientes');
    }


    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.verCliente', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $imagen_url = asset('imagesCliente/' . $cliente->fotografia);
        return view('clientes.editarClientes', compact('cliente', 'imagen_url'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fotografia' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required',
            'codigo' => 'required',
            'empresa' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
        ]);

        // Actualización de datos
        if($request->hasFile('fotografia')){
            $imageName = time().'.'.$request->fotografia->extension();  
            $request->fotografia->move(public_path('imagesCliente'), $imageName);
        } else {
            $imageName = Cliente::find($id)->fotografia;
        }

        Cliente::where('id', $id)->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'fotografia' => $imageName
        ]);

        return redirect()->route('clientes');
}



    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes');
    }
}