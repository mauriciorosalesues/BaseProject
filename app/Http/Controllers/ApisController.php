<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApisController extends Controller
{
    // Función para mostrar la vista apis.blade.php
    public function mostrarVistaApis()
    {
        return view('vistaApis.apis');
    }

    public function mostrarVistaWorkers()
    {
        return view('vistaApis.workers');
    }

}