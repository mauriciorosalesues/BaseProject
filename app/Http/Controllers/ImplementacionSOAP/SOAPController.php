<?php

namespace App\Http\Controllers\ImplementacionSOAP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SoapClient;
use SoapFault;

class SOAPController extends Controller
{
    //Esta función dirige a la vista donde se capturaran los datos para la operacion aritmética (Suma o multiplicacion)
    public function capturarSolicitud()
    {
        //Dentro del view se debe colocar el nombre de la vista para llamarla
        return view('VistaSolicitudAqui');
    }

    //Esta función utiliza los datos capturados para realizar la operacion aritmética (suma o multiplicación, al final envía a la vosta donde se muestra em resultado
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

        //En el view se debe colocar el nombre de la vista donde se muestra el rwsultado, para llamarla
        return view('VistaResultadoAqui', compact('num1', 'num2', 'operacion', 'resultado', 'error'));
    }
}