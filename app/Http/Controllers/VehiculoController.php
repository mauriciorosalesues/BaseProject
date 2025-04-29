<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    public function mostrarXMLVehiculos()
    {
        $ruta = storage_path('/xml/carros.xml');
        
        // En caso no exista el archivo
        if (!file_exists($ruta)) {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }

        $xmlContent = file_get_contents($ruta);
        $xml = simplexml_load_string($xmlContent);
        $json = json_encode($xml);

        // Retorna el JSON del XML a la vista
        return view('frontend.vehiculos.index', ['vehiculosJson' => $json]);
    }
}