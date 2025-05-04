<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class XMLToJsonController extends Controller
{
    /**
     * Convertir XML a JSON.
     * Se convertirá un XML a JSON. desde  storage/xml/datos.xml
     * 
     *
     */
    private $contenido_json = "";
    private $contenido_xml = "";
    public function __construct()
    {
        //activar el middleware de autenticacion
        //$this->middleware('auth');
        $path = 'public/xml/datos.xml';
        if (!Storage::disk('local')->exists($path)) {
            $this->contenido_json = "El archivo XML no existe.";
            $this->contenido_xml = "El archivo XML no existe.";
        }
        //Se obtiene el contenido del archivo XML
        $this->contenido_xml = Storage::disk('local')->get($path);

        // Cargar XML y convertir a JSON usando metodo de la clase SimpleXMLElement
        $xmlObject = simplexml_load_string($this->contenido_xml);

        //Convierte el XML a JSON, con formato legible y sin caracteres unicode
        $this->contenido_json = json_encode($xmlObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public function convertXMLToJson()
    {
        return view(
            'frontend.xml.showXmlAndJsonFormat',
            [
                'xml' => htmlspecialchars($this->contenido_xml), // Para mostrar bien el XML
                'json' => $this->contenido_json
            ]
        );
    }
    /**
     * Mostrar el JSON convertido.
     *
     * @return \Illuminate\Http\JsonResponse
     */ public function showJson()
    {
        //Elimina los caracteres de escape y lo conveirte a un array
        $data = json_decode($this->contenido_json, true); 
        //retorna el JSON
        return response()->json($data, 200);

    }
}
