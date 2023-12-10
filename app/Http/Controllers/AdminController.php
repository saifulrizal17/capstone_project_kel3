<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\CatatanKeuangan;
use App\Labarugi;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labarugiData = Labarugi::orderBy('bulan')->get();

        $labels = [];
        $pendapatan = [];
        $pengeluaran = [];

        // Pemetaan nama bulan ke urutan
        $monthMapping = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        // Inisialisasi data untuk setiap bulan
        foreach (range(1, 12) as $month) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 1));
            $pendapatan[] = 0;
            $pengeluaran[] = 0;
        }

        // Mengisi data yang sesuai dari Labarugi
        foreach ($labarugiData as $labarugi) {
            $index = $monthMapping[$labarugi->bulan] - 1;
            $pendapatan[$index] = $labarugi->pendapatan;
            $pengeluaran[$index] = $labarugi->pengeluaran;
        }

        // Data untuk grafik catatan keuangan
        $incomeAll = CatatanKeuangan::where('id_jenis', 1)->sum('jumlah');
        $expenseAll = CatatanKeuangan::where('id_jenis', 2)->sum('jumlah');
        $balanceAll = $incomeAll - $expenseAll;

        // Data untuk grafik dashboard
        $totalUsers = User::count();
        $totalActiveUsers = User::where('is_active', true)->count();
        $percentageActiveUsers = ($totalActiveUsers / $totalUsers) * 100;
        $totalAdmins = User::where('role_id', 1)->count();
        $totalUsers = User::where('role_id', 2)->count();
        $totalVisitors = 'NaN';

        return view('admin.dashboard', [
            'balanceAll' => $balanceAll,
            'incomeAll' => $incomeAll,
            'expenseAll' => $expenseAll,
            'percentageActiveUsers' => $percentageActiveUsers,
            'totalActiveUsers' => $totalActiveUsers,
            'totalAdmins' => $totalAdmins,
            'totalUsers' => $totalUsers,
            'totalVisitors' => $totalVisitors,
            'labels' => $labels,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
