<?php

namespace App\Http\Controllers;

use App\CatatanKeuangan;
use App\Exports\CatatanKeuanganExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            $catatanKeuangans = CatatanKeuangan::orderBy('tanggal_transaksi', 'asc')->get();
        } else {
            // User
            $user = Auth::user();
            $catatanKeuangans = CatatanKeuangan::where('id_user', $user->id)
                ->orderBy('tanggal_transaksi', 'asc')
                ->get();
        }

        $jeniss = \App\JenisCatatanKeuangan::all();

        return view('all_role.catatan_keuangan.index', [
            'catatanKeuangans' => $catatanKeuangans,
            'jeniss' => $jeniss,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\User::all();
        $jeniss = \App\JenisCatatanKeuangan::all();
        $kategoris = \App\KategoriCatatanKeuangan::all();
        return view('all_role.catatan_keuangan.create', [
            'users' => $users,
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
            'jumlah' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $validatedData['jumlah'] = str_replace(',', '', $validatedData['jumlah']);

        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $validatedData['id_user'] = $request->input('id_user');
        } else {
            // User
            $validatedData['id_user'] = Auth::id();
        }

        $catatankeuangan = new CatatanKeuangan($validatedData);

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
        $users = \App\User::all();
        $jeniss = \App\JenisCatatanKeuangan::all();
        $kategoris = \App\KategoriCatatanKeuangan::all();
        return view('all_role.catatan_keuangan.index', [
            'catatanKeuangan' => $catatanKeuangan,
            'users' => $users,
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
        $users = \App\User::all();
        $jeniss = \App\JenisCatatanKeuangan::all();
        $kategoris = \App\KategoriCatatanKeuangan::all();
        return view('all_role.catatan_keuangan.edit', [
            'catatanKeuangan' => $catatanKeuangan,
            'users' => $users,
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
            'jumlah' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $validatedData['jumlah'] = str_replace(',', '', $validatedData['jumlah']);

        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin 
            $validatedData['id_user'] = $request->input('id_user');
        } else {
            // User
            $validatedData['id_user'] = $catatanKeuangan->id_user;
        }

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

    public function filter(Request $request)
    {
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $query = CatatanKeuangan::query();
        } else {
            // User
            $query = CatatanKeuangan::where('id_user', auth()->user()->id);
        }

        $jenis = $request->input('jenis');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($jenis) {
            $query->where('id_jenis', $jenis);
        }

        if ($start_date) {

            $query->whereDate('tanggal_transaksi', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('tanggal_transaksi', '<=', $end_date);
        }

        $catatanKeuangans = $query->get();
        $jeniss = \App\JenisCatatanKeuangan::all();

        session(['filtered_data' => $catatanKeuangans]);

        return view('all_role.catatan_keuangan.index', [
            'catatanKeuangans' => $catatanKeuangans,
            'jeniss' => $jeniss,
        ]);
    }

    public function viewPDF(Request $request)
    {
        $filteredData = session('filtered_data');

        if (!$filteredData) {
            $query = CatatanKeuangan::query();
            $filteredData = $query->get();
        }

        $pdfContent = view('all_role.catatan_keuangan.viewpdf', compact('filteredData'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($pdfContent);
        $mpdf->Output();
    }

    public function exportPDF(Request $request)
    {
        $filteredData = session('filtered_data');

        if (!$filteredData) {
            $query = CatatanKeuangan::query();
            $filteredData = $query->get();
        }

        $pdfContent = view('all_role.catatan_keuangan.viewpdf', compact('filteredData'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($pdfContent);
        $filename = 'download-pdf-catatan-keuangan.pdf';
        $mpdf->Output($filename, 'D');
    }

    public function exportExcel(Request $request)
    {
        $filteredData = session('filtered_data');

        if (!$filteredData) {
            $query = CatatanKeuangan::query();
            $filteredData = $query->get();
        }

        $filename = 'download-excel-catatan-keuangan.xlsx';
        $filteredDataArray = $filteredData->toArray();

        return Excel::download(new CatatanKeuanganExport($filteredDataArray), $filename);
    }
}
