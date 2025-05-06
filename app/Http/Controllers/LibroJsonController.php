<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class LibroJsonController extends Controller
{
    public function mostrarLibros()
    {
        $rutaArchivoXml = storage_path('/xml/libros.xml');

        $contenidoXml = file_get_contents($rutaArchivoXml);

        $xmlParseado = simplexml_load_string($contenidoXml);

        return response()
            ->json($xmlParseado, 200, [], JSON_UNESCAPED_UNICODE);
    }

}
