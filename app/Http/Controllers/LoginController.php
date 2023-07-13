<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        // Mostrar la vista de login de usuarios
        return view('auth.login');
    }
    public function store(Request $request){
        $this->validate($request,[
            //Reglas de validacion 
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Verificar que las credenciales sean correctas
        if(!auth()->attempt($request->only('email','password'), $request ->remember)){
            // Usar la directiva "with" para llenar los valores de la sesión
            // Si las credenciales ingresadas no coinciden con las de la base de datos, retornara el mensaje
            return back()->with('mensaje','Credenciales incorrectas');
        }
        // Credenciales correctas
        return redirect()->route('dashboard', auth()->user()->username);
        
    }
}
