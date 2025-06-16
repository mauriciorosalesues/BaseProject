<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use IlluminateHttpRequest;
use AppModelsPost;
use function PHPUnit\Framework\returnArgument;

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
    {   //validacion de datos
       $request->validate([
        'name' => 'required|string|max:100',
        'telefono' => 'required|integer|min:8',
        'correo' => 'required|email',
        'direccion' => 'required|string',
        'tipo' => 'required|in:Nuevo,Frecuente,Preferencial',//cambio de texto a un combobox
    ]);
    

    // Crear cliente
    Cliente::create($request->all());

        return redirect()->route('clientes.index');
    }

    
    public function show(string $id)
    {
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
        $cliente= Cliente::findOrFail($id);
        $cliente ->delete();
        return redirect()->route('clientes.index');

    }
}
