<?php

namespace App\Http\Controllers;

use App\CatatanKeuangan;

use Illuminate\Http\Request;


class CatatanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatanKeuangans = CatatanKeuangan::all();
        return view('CatatanKeuangan.index', compact('catatanKeuangans'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CatatanKeuangan.create');
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
            'id_user' => 'nullable|numeric',
            'tanggal_transaksi' => 'nullable|date',
            'jumlah' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'jenis' => 'nullable|in:pemasukan,pengeluaran',
            'kategori' => 'nullable|string',
        ]);

        CatatanKeuangan::create($request->all());

        return redirect()->route('catatan_keuangan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanKeuangan $catatanKeuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanKeuangan $catatanKeuangan)
    {
        return view('CatatanKeuangan.edit', [
            'catatanKeuangan' => $catatanKeuangan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatatanKeuangan $catatanKeuangan)
    {
        $request->validate([
            'id_user' => 'nullable|numeric',
            'tanggal_transaksi' => 'nullable|date',
            'jumlah' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'jenis' => 'nullable|in:pemasukan,pengeluaran',
            'kategori' => 'nullable|string',
        ]);

        $catatanKeuangan->update($request->all());

        return redirect()->route('catatan_keuangan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanKeuangan $catatanKeuangan)
    {
        $catatanKeuangan->delete();

        return redirect()->route('catatan_keuangan.index');
    }
}
