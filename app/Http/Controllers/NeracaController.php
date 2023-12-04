<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Neraca;

class NeracaController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $neracas = Neraca::all();
        } else {
            // User
            $user = Auth::user();
            $neracas = Neraca::where('id_user', $user->id)->get();
        }

        return view('neraca.index', compact('neracas'));
    }
}
