<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventoController extends Controller
{
    public function mostrarEventos()
    {
        // Ruta al archivo XML creado en el punto 1
        $rutaXml = storage_path('xml/eventos.xml');

        // Verificar si el archivo existe
        if (!File::exists($rutaXml)) {
            return response()->json(['error' => 'Archivo XML no encontrado'], 404);
        }

        // cargar el XML
        $xmlContent = simplexml_load_file($rutaXml);
        
        // convertir a JSON, luego a array
        $json = json_encode($xmlContent);
        $eventos = json_decode($json, true)['evento'];

        // retornar a la vista con los datos
        return view('frontend.eventos.preferencias', ['eventos' => $eventos]); //cambiar nombre --preferencias-- yo o puse como supocisión de que así se llamara el blade.php
    }
}