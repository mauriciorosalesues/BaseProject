<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibroController extends Controller
{
   public function mostrarLibros()
   {
        $rutaArchivoXml = storage_path('/xml/libros.xml');

        $contenidoXml = file_get_contents($rutaArchivoXml);

        $xmlParseado = simplexml_load_string($contenidoXml);

        $librosEnFormatoJson = json_encode($xmlParseado);  
        
        return view('vista_libros', ['librosEnFormatoJson' => $librosEnFormatoJson]);
   }
}
