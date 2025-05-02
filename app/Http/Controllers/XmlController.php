<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XmlController extends Controller
{
    public function showXmlTable()
    {
        $xmldatos = file_get_contents(storage_path('xml/listado.xml'));
        $xmlobjeto = simplexml_load_string($xmldatos);
        $json = json_encode($xmlobjeto);
        $array = json_decode($json, true);

        return view('frontend.preferencias', ['clientes' => $array]);
    }
}
