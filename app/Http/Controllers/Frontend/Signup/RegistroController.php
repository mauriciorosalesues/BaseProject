<?php

namespace App\Http\Controllers\Frontend\Signup;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function index()
    {
        return view('frontend.signup.vistaregistro');
    }

    public function create()
    {
       return view('frontend.signup.vistaregistro');
    }

    
    public function store(Request $request)
    {
        //Determinar los valores de algunas columnas de la tabla usuarios
        $request->merge([
        'usuario' => $request->input('nombre'),
        'activo'=>1,
        //encriptar la password para validar el login
        'password'=> bcrypt($request->input('password'))
        ]);
       $request->validate([
        'nombre' => 'required|string|max:100',
        'activo'=> 'required',
        'usuario' => 'same:nombre',
        'password' => 'required',
        
        ]);

    // Crear cliente
        Usuario::create($request->all());

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
