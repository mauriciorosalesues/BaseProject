<?php

namespace App\Http\Controllers\ImplementacionSOAP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SoapClient;
use SoapFault;

class SOAPController extends Controller
{
    public function capturarSolicitud()
    {
        return view('VistaSolicitudAqui');
    }

    public function procesarSolicitud(Request $request)
    {
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $operacion = $request->input('operacion');
        $resultado = null;
        $error = null;

        try {
            $client = new SoapClient('https://www.dneonline.com/calculator.asmx?WSDL');

            switch ($operacion) {
                case 'sumar':
                    $params = ['intA' => $num1, 'intB' => $num2];
                    $result = $client->Add($params);
                    $resultado = $result->AddResult;
                    break;
                case 'multiplicar':
                    $params = ['intA' => $num1, 'intB' => $num2];
                    $result = $client->Multiply($params);
                    $resultado = $result->MultiplyResult;
                    break;
                default:
                    $error = 'Operación no válida.';
                    break;
            }

        } catch (SoapFault $e) {
            $error = 'Error al conectar con el servicio SOAP: ' . $e->getMessage();
        }

        return view('VistaResultadoAqui', compact('num1', 'num2', 'operacion', 'resultado', 'error'));
    }
}