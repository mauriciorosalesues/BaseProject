<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    // Función para mostrar la vista worker.blade.php
    public function mostrarWebWorker()
    {
        return view('backend.admin.dashboard.workers');
    }
}
