<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrondendController extends Controller
{
    public function index()
    {
        return view('frondend.index');
    }
}
