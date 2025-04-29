<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $xmlPath = storage_path('xml/libros.xml');

        if (!file_exists($xmlPath)) {
            return response()->json(['error' => 'Archivo XML no encontrado'], 404);
        }

        $xmlContent = simplexml_load_file($xmlPath);

        // Convertir XML a array
        $librosArray = json_decode(json_encode($xmlContent), true);

        // Asegurar que siempre sea un array de libros
        if (isset($librosArray['libro']) && !isset($librosArray['libro'][0])) {
            $librosArray['libro'] = [$librosArray['libro']];
        }

        // Validar que cada libro tenga los campos requeridos
        $librosValidados = [];
        foreach ($librosArray['libro'] as $libro) {
            if (
                isset($libro['id']) &&
                isset($libro['titulo']) &&
                isset($libro['autor']) &&
                isset($libro['anio']) &&
                isset($libro['editorial'])
            ) {
                $librosValidados[] = $libro;
            }
        }

        // Si no hay libros válidos, mostrar mensaje de error
        if (empty($librosValidados)) {
            return response()->json(['error' => 'No hay libros válidos en el XML'], 422);
        }

        // Pasar los libros validados a la vista
        return view('libros.index', ['libros' => ['libro' => $librosValidados]]);
    }
}
