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

        foreach (range(1, 12) as $month) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 1));
            $pendapatan[] = 0;
            $pengeluaran[] = 0;
        }

        foreach ($labarugiData as $labarugi) {
            $index = $monthMapping[$labarugi->bulan] - 1;
            $pendapatan[$index] = $labarugi->pendapatan;
            $pengeluaran[$index] = $labarugi->pengeluaran;
        }

        $incomeAll = CatatanKeuangan::where('id_jenis', 1)->sum('jumlah');
        $expenseAll = CatatanKeuangan::where('id_jenis', 2)->sum('jumlah');
        $balanceAll = $incomeAll - $expenseAll;

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
}
