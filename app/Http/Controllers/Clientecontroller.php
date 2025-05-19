<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use IlluminateHttpRequest;
use AppModelsPost;

class Clientecontroller extends Controller
{
    
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientesindex', compact('clientes'));
    }

    
    public function create()
    {
        return view('clientescreate');
    }

    
    public function store(Request $request)
    {
       //falta validaciones
        $cliente = new Cliente();
        $cliente->name = $request->name;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->tipo = $request->tipo;
        $cliente->save();

        return redirect()->route('clientes.index');
    }

    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }
}
