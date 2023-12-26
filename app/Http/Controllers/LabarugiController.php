<?php

namespace App\Http\Controllers;

use App\Labarugi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            $data = DB::table('tbl_catatan_keuangans')
                ->join('tbl_users', 'tbl_catatan_keuangans.id_user', '=', 'tbl_users.id')
                ->select(
                    'tbl_users.id',
                    'tbl_users.name',
                    DB::raw('SUM(CASE WHEN id_jenis = 1 THEN jumlah ELSE 0 END) as pendapatan'),
                    DB::raw('SUM(CASE WHEN id_jenis = 2 THEN jumlah ELSE 0 END) as pengeluaran'),
                    DB::raw("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan")
                )
                ->groupBy('bulan', 'tbl_users.id', 'tbl_users.name')
                ->get();
        } else {
            // User
            $userId = Auth::id();
            $data = DB::table('tbl_catatan_keuangans')
                ->join('tbl_users', 'tbl_catatan_keuangans.id_user', '=', 'tbl_users.id')
                ->select(
                    'tbl_users.id',
                    'tbl_users.name',
                    DB::raw('SUM(CASE WHEN id_jenis = 1 THEN jumlah ELSE 0 END) as pendapatan'),
                    DB::raw('SUM(CASE WHEN id_jenis = 2 THEN jumlah ELSE 0 END) as pengeluaran'),
                    DB::raw("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan")
                )
                ->where('tbl_users.id', $userId)
                ->groupBy('bulan', 'tbl_users.id', 'tbl_users.name')
                ->get();
        }

        foreach ($data as $row) {
            $row->bulan = Carbon::parse($row->bulan)->isoFormat('MMMM Y');
        }

        return view('all_role.laba_rugi.index', compact('data'));
    }
}
