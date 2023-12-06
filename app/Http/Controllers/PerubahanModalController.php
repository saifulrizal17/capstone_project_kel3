<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerubahanModal;
use Illuminate\Support\Facades\Auth;


class PerubahanModalController extends Controller
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
            $perubahanModals = PerubahanModal::all();
        } else {
            // User
            $user = Auth::user();
            $perubahanModals = PerubahanModal::where('id_user', $user->id)->get();
        }
        return view('perubahan_modals.index', compact('perubahanModals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\User::all();
        return view('perubahan_modals.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_perubahan' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin 
            $request->validate([
                'id_user' => 'required',
            ]);
        } else {
            // User
            $request['id_user'] = $user->id;
        }

        PerubahanModal::create($request->all());

        return redirect()->route('perubahanmodal.index')
            ->with('success', 'Perubahan Modal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perubahanModal = PerubahanModal::findOrFail($id);
        $users = \App\User::all();
        return view('perubahan_modals.index', compact('perubahanModal', 'users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perubahanModal = PerubahanModal::findOrFail($id);
        $users = \App\User::all();
        return view('perubahan_modals.edit', compact('perubahanModal', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_perubahan' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin 
            $request->validate([
                'id_user' => 'required',
            ]);
        } else {
            // User
            $request['id_user'] = PerubahanModal::findOrFail($id)->id_user;
        }

        PerubahanModal::findOrFail($id)->update($request->all());

        return redirect()->route('perubahanmodal.index')
            ->with('success', 'Perubahan Modal berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PerubahanModal::findOrFail($id)->delete();

        return redirect()->route('perubahanmodal.index')
            ->with('success', 'Perubahan Modal berhasil dihapus');
    }
}
