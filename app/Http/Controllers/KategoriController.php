<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::with('jenis')->get(); // Memuat relasi jenis untuk menghindari masalah N+1
        return view('admin.kategori.index', compact('kategoris'));
        // $kategoris = Kategori::all();
        // return view('admin.kategori.index', compact('kategoris'));
        // return view('admin.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jeniss = \App\Jenis::all();
        return view('admin.kategori.create', [
            'jeniss' => $jeniss
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
            'jenis_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $kategori = new Kategori($validatedData);
        $kategori->save();

        return redirect()->route('admin.kategori.index', $kategori->id)
            ->with('success', 'Mata Pelajaran berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jeniss = \App\Jenis::all();
        return view('admin.kategori.index', [
            'kategori' => $kategori,
            'jeniss' => $jeniss
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Kategori $kategori)
    {
        $jeniss = \App\Jenis::all();
        return view('admin.kategori.edit', [
            'kategori' => $kategori,
            'jeniss' => $jeniss
        ]);
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
        $validatedData = $request->validate([
            'jenis_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return redirect()->route('admin.kategori.index', $kategori->id)
            ->with('success', 'Data Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Data Kategori berhasil dihapus.');
    }
}
