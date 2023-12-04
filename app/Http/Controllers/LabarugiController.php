<?php

namespace App\Http\Controllers;

use App\Labarugi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $labarugiData = Labarugi::all();
        } else {
            // User
            $user = Auth::user();
            $labarugiData = Labarugi::where('id_user', $user->id)->get();
        }

        return view('Labarugi.index', compact('labarugiData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Labarugi  $labarugi
     * @return \Illuminate\Http\Response
     */
    public function show(Labarugi $labarugi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Labarugi  $labarugi
     * @return \Illuminate\Http\Response
     */
    public function edit(Labarugi $labarugi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Labarugi  $labarugi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Labarugi $labarugi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Labarugi  $labarugi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labarugi $labarugi)
    {
        //
    }
}
