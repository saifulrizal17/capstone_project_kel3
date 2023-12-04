<?php

namespace App\Http\Controllers;

use App\CatatanKeuangan;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $catatanKeuangans = CatatanKeuangan::all();
        } else {
            // User
            $user = Auth::user();
            $catatanKeuangans = CatatanKeuangan::where('id_user', $user->id)->get();
        }

        return view('CatatanKeuangan.index', compact('catatanKeuangans'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jeniss = \App\Jenis::all();
        $kategoris = \App\Kategori::all();
        return view('CatatanKeuangan.create', [
            'jeniss' => $jeniss,
            'kategoris' => $kategoris
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
        $validatedData = $request->validate([
            'id_jenis' => 'required',
            'id_kategori' => 'required',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Fix the typo in variable name
        $catatankeuangan = new CatatanKeuangan($validatedData);

        // Set the user ID after creating the instance
        $catatankeuangan->id_user = Auth::id();

        // Save the instance
        $catatankeuangan->save();

        return redirect()->route('aruskas.index', $catatankeuangan->id)
            ->with('success', 'Catatan Keuangan berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanKeuangan $catatanKeuangan)
    {
        $jeniss = \App\Jenis::all();
        $kategoris = \App\Kategori::all();
        return view('CatatanKeuangan.index', [
            'catatanKeuangan' => $catatanKeuangan,
            'jeniss' => $jeniss,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatatanKeuangan  $catatanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanKeuangan $catatanKeuangan)
    {
        $jeniss = \App\Jenis::all();
        $kategoris = \App\Kategori::all();
        return view('CatatanKeuangan.edit', [
            'catatanKeuangan' => $catatanKeuangan,
            'jeniss' => $jeniss,
            'kategoris' => $kategoris
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
        $validatedData = $request->validate([
            'id_jenis' => 'required',
            'id_kategori' => 'required',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $catatanKeuangan->update($validatedData);

        return redirect()->route('aruskas.index', $catatanKeuangan->id)
            ->with('success', 'Catatan Keuangan berhasil diperbarui.');
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

        return redirect()->route('aruskas.index')
            ->with('success', 'Catatan Keuangan berhasil dihapus.');
    }
}
