<?php

namespace App\Http\Controllers\Controles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisaninweb\SoapWrapper\SoapWrapper;

class NumberConversionController extends Controller
{
    protected $soapWrapper;
    protected $wsdlUrl = 'https://www.dataaccess.com/webservicesserver/NumberConversion.wso?WSDL';

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;

        $this->soapWrapper->add('NumberConversion', function ($service) {
            $service
                ->wsdl($this->wsdlUrl)
                ->trace(true)
                ->options([
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'exceptions' => true,
                    'connection_timeout' => 15,
                    'stream_context' => stream_context_create([
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        ]
                    ])
                ]);
        });
    }

    public function index()
    {
        return view('number.converter');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric|min:0|max:999999999999999.99',
            'conversion_type' => 'required|in:words,dollars'
        ]);

        try {
            if ($request->conversion_type === 'words') {
                $params = [
                    'NumberToWords' => [
                        'ubiNum' => $request->number
                    ]
                ];
                $method = 'NumberToWords';
            } else {
                $params = [
                    'NumberToDollars' => [
                        'dNum' => $request->number
                    ]
                ];
                $method = 'NumberToDollars';
            }

            $response = $this->soapWrapper->call("NumberConversion.$method", $params);

            $result = [
                'original_number' => $request->number,
                'converted_text' => $response->{$method . 'Result'},
                'conversion_type' => $request->conversion_type,
                'success' => true
            ];

        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'error' => 'Error en el servicio: ' . $e->getMessage(),
                'fallback_result' => $this->getFallbackConversion($request->number, $request->conversion_type)
            ];
        }

        return back()->with([
            'result' => $result,
            'old' => $request->all()
        ]);
    }

    private function getFallbackConversion($number, $type)
    {
        if ($type === 'words') {
            return "Fallback: " . $this->numberToWords($number);
        } else {
            return "Fallback: " . $this->numberToDollars($number);
        }
    }

    private function numberToWords($number)
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }

    private function numberToDollars($number)
    {
        $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($number, 'USD');
    }
}       