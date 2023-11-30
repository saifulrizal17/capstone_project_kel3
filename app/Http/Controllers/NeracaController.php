<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Neraca;

class NeracaController extends Controller
{
    public function index()
    {
        $neracas = Neraca::all();

        return view('neraca.index', compact('neracas'));
    }
}
