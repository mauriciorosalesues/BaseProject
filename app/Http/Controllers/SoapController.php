<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapController extends Controller
{
    public function showCalculator()
    {
        return view('calculator.form');
    }

    public function sumar(Request $request)
    {
        $request->validate([
            'intA' => 'required|numeric',
            'intB' => 'required|numeric'
        ]);

        $client = new \SoapClient('http://www.dneonline.com/calculator.asmx?WSDL');
        $params = [
            'intA' => $request->intA,
            'intB' => $request->intB
        ];

        $result = $client->__soapCall('Add', [$params]);

        return view('calculator.form', [
            'operation' => 'suma',
            'result' => $result->AddResult,
            'intA' => $request->intA,
            'intB' => $request->intB
        ]);
    }

    public function multiplicar(Request $request)
    {
        $request->validate([
            'intA' => 'required|numeric',
            'intB' => 'required|numeric'
        ]);

        $client = new \SoapClient('http://www.dneonline.com/calculator.asmx?WSDL');
        $params = [
            'intA' => $request->intA,
            'intB' => $request->intB
        ];

        $result = $client->__soapCall('Multiply', [$params]);

        return view('calculator.form', [
            'operation' => 'multiplicación',
            'result' => $result->MultiplyResult,
            'intA' => $request->intA,
            'intB' => $request->intB
        ]);
    }
}