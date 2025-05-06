<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Mostrar la vista de información.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retorna la vista "info.index"
        return view('frontend.info.vista_info');
    }
}