<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
   public function show()
    {
        $city = 'San Salvador';
        $apiKey = config('services.openweather.key');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'es'
        ]);

        $data = $response->json();

        $weather = [
            'city' => $data['name'] ?? 'Desconocido',
            'temp' => $data['main']['temp'] ?? 'N/A',
            'description' => $data['weather'][0]['description'] ?? 'N/A',
            'icon' => $data['weather'][0]['icon'] ?? null
        ];

        return view('weather', compact('weather'));
    }


}

?>

