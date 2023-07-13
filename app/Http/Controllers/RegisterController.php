<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    // Ruta para vista registro de usuarios
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Modicamos el Request para que no se repitan los username
        $request->request-> add(['username'=>STR::slug($request->username)]);
        
        // Validaciones del formulario de registro para esto se utilizan los "name" de los campos del formulario
        $this->validate($request, [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6', //confirmed hace que se tenga que confirmar la contraseña de nuevo
            'password_confirmation' => '',
        ]);
        
        // dd('Mensaje: Creando cuenta...');

        // Invocar el modelo User para crear el registro
        User::create([
            'name' => $request->name,
            // // Insertar username en minuscula y sin espacios
            // 'username' => Str::slug($request->username),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), //Para mantener segura la contraseña se encrypta

        ]);

        // Autenticar un usuario con el método "attemp"
        
            // Opcion 1
            // auth()->attempt([
            //     'email'=>$request->email,
            //     'password' => $request->password,
            // ]);

            // Opcion 2
            auth()->attempt($request->only('email','password'));

        // Redireccionando
        return redirect()->route('dashboard', auth()->user()->username);
    }
}