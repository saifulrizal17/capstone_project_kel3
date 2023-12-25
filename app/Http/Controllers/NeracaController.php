<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Neraca;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NeracaController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            $data = DB::table('tbl_perubahan_modals')
                ->join('tbl_users', 'tbl_perubahan_modals.id_user', '=', 'tbl_users.id')
                ->select(
                    'tbl_users.id',
                    'tbl_users.name',
                    DB::raw('SUM(CASE WHEN id_jenis = 1 THEN jumlah ELSE 0 END) as aset'),
                    DB::raw('SUM(CASE WHEN id_jenis = 2 THEN jumlah ELSE 0 END) as kewajiban'),
                    DB::raw('SUM(CASE WHEN id_jenis = 3 THEN jumlah ELSE 0 END) as ekuitas'),
                    DB::raw("DATE_FORMAT(tanggal_perubahan, '%Y-%m') as bulan")
                )
                ->groupBy('bulan', 'tbl_users.id', 'tbl_users.name')
                ->get();
        } else {
            // User
            $userId = Auth::id();
            $data = DB::table('tbl_perubahan_modals')
                ->join('tbl_users', 'tbl_perubahan_modals.id_user', '=', 'tbl_users.id')
                ->select(
                    'tbl_users.id',
                    'tbl_users.name',
                    DB::raw('SUM(CASE WHEN id_jenis = 1 THEN jumlah ELSE 0 END) as aset'),
                    DB::raw('SUM(CASE WHEN id_jenis = 2 THEN jumlah ELSE 0 END) as kewajiban'),
                    DB::raw('SUM(CASE WHEN id_jenis = 3 THEN jumlah ELSE 0 END) as ekuitas'),
                    DB::raw("DATE_FORMAT(tanggal_perubahan, '%Y-%m') as bulan")
                )
                ->where('tbl_users.id', $userId)
                ->groupBy('bulan', 'tbl_users.id', 'tbl_users.name')
                ->get();
        }

        foreach ($data as $row) {
            $row->bulan = Carbon::parse($row->bulan)->isoFormat('MMMM Y');
        }

        return view('neraca.index', compact('data'));
    }
}
