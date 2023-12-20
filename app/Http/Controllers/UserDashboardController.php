<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanKeuangan;
use App\Labarugi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\PerubahanModal;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $labarugiData = Labarugi::where('id_user', $userId)->orderBy('bulan')->get();

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

        $data = PerubahanModal::where('id_user', $userId)
            ->select('id_jenis', \DB::raw('SUM(jumlah) as total'))
            ->groupBy('id_jenis')
            ->get();

        $labelspm = [];
        $values = [];

        foreach ($data as $item) {
            switch ($item->id_jenis) {
                case 1:
                    $labelspm[] = 'Aset';
                    break;
                case 2:
                    $labelspm[] = 'Kewajiban';
                    break;
                case 3:
                    $labelspm[] = 'Ekuitas';
                    break;
            }

            $values[] = $item->total;
        }

        $incomeAll = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 1)
            ->sum('jumlah');

        $expenseAll = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 2)
            ->sum('jumlah');

        $balanceAll = $incomeAll - $expenseAll;

        $incomeMonthNow = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 1)
            ->whereYear('tanggal_transaksi', Carbon::now()->year)
            ->whereMonth('tanggal_transaksi', Carbon::now()->month)
            ->sum('jumlah');

        $expenseMonthNow = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 2)
            ->whereYear('tanggal_transaksi', Carbon::now()->year)
            ->whereMonth('tanggal_transaksi', Carbon::now()->month)
            ->sum('jumlah');

        $balanceMonthNow = $incomeMonthNow - $expenseMonthNow;

        $incomeTodayNow = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 1)
            ->whereDate('tanggal_transaksi', Carbon::today())
            ->sum('jumlah');

        $expenseTodayNow = CatatanKeuangan::where('id_user', $userId)
            ->where('id_jenis', 2)
            ->whereDate('tanggal_transaksi', Carbon::today())
            ->sum('jumlah');

        $balanceTodayNow = $incomeTodayNow - $expenseTodayNow;

        return view('user.dashboard', [
            'balanceAll' => $balanceAll,
            'incomeAll' => $incomeAll,
            'expenseAll' => $expenseAll,
            'balanceMonthNow' => $balanceMonthNow,
            'incomeMonthNow' => $incomeMonthNow,
            'expenseMonthNow' => $expenseMonthNow,
            'balanceTodayNow' => $balanceTodayNow,
            'incomeTodayNow' => $incomeTodayNow,
            'expenseTodayNow' => $expenseTodayNow,
            'labels' => $labels,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'labelspm' => $labelspm,
            'values' => $values,
        ]);
    }
}
