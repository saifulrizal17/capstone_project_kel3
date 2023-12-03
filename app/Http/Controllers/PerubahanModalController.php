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
        $perubahanModals = PerubahanModal::all();
        return view('perubahan_modals.index', compact('perubahanModals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perubahan_modals.create');
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

        // Get the currently logged-in user
        $user = Auth::user();

        // Add the user ID to the request data
        $requestData = $request->all();
        $requestData['id_user'] = $user->id;

        // Simpan data baru ke dalam tabel
        PerubahanModal::create($requestData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('perubahanmodal.index')->with('success', 'Data berhasil ditambahkan');
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

        return view('perubahan_modals.index', compact('perubahanModal'));
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

        return view('perubahan_modals.edit', compact('perubahanModal'));
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

        PerubahanModal::findOrFail($id)->update($request->all());

        return redirect()->route('perubahanmodal.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan data berdasarkan ID dan hapus
        PerubahanModal::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('perubahanmodal.index')->with('success', 'Data berhasil dihapus');
    }
}
