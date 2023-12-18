<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriCatatanKeuangan;
use Yajra\DataTables\Facades\DataTables;

class KategoriAjaxController extends Controller
{
    public function index()
    {
        $kategoris = KategoriCatatanKeuangan::all();

        return Datatables::of($kategoris)
            ->addColumn('jenis.name', function ($kategori) {
                return $kategori->jenis->name ?? 'Tidak Tersedia';
            })
            ->addColumn('action', function ($kategori) {
                return view('admin.kategori.actions', compact('kategori'))->render();
            })
            ->make(true);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $kategori = KategoriCatatanKeuangan::find($id);

            if (!$kategori) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $kategori->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting data', 'details' => $e->getMessage()], 500);
        }
    }
}
