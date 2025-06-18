<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
   public function show()
    {
        return view('weather');
    }


}

?>

