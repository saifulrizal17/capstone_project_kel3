<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TblPerubahanModal;


class TblPerubahanModalController extends Controller
{
   
public function index()
{
    $perubahanModals = TblPerubahanModal::all(); // Ubah ini sesuai dengan cara Anda mendapatkan data

    return view('perubahan_modals.index', compact('perubahanModals'));
}


    public function create()
    {
        // Tampilkan formulir tambah data
        return view('perubahan_modals.create');
    }

    public function store(Request $request)
    {
        // Validasi data dari formulir
        $request->validate([
            'id_user' => 'required',
            'tanggal_perubahan' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        // Simpan data baru ke dalam tabel
        TblPerubahanModal::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('perubahanModal')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $perubahanModal = TblPerubahanModal::findOrFail($id);
    
        return view('perubahan_modals.edit', compact('perubahanModal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_perubahan' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);
    
        TblPerubahanModal::findOrFail($id)->update($request->all());
    
        return redirect()->route('perubahanModal')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        // Temukan data berdasarkan ID dan hapus
        TblPerubahanModal::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('perubahanModal')->with('success', 'Data berhasil dihapus');
    }
}
