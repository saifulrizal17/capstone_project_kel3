<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanKeuangan;
use App\Labarugi;
use Illuminate\Support\Facades\Auth;
use App\PerubahanModal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // Neraca
        $dataNeraca = DB::table('tbl_perubahan_modals')
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

        $neracaLabels = [];
        $neracaAset = [];
        $neracaKewajiban = [];
        $neracaEkuitas = [];

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
            $neracaLabels[] = date('F', mktime(0, 0, 0, $month, 1));
            $neracaAset[] = 0;
            $neracaKewajiban[] = 0;
            $neracaEkuitas[] = 0;
        }

        foreach ($dataNeraca as $row) {
            $index = $monthMapping[Carbon::parse($row->bulan)->isoFormat('MMMM')] - 1;
            $neracaAset[$index] = $row->aset;
            $neracaKewajiban[$index] = $row->kewajiban;
            $neracaEkuitas[$index] = $row->ekuitas;
        }

        //Laba Rugi
        $dataLabaRugi = DB::table('tbl_catatan_keuangans')
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

        $labaRugiLabels = [];
        $labaRugiPendapatan = [];
        $labaRugiPengeluaran = [];

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
            $labaRugiLabels[] = date('F', mktime(0, 0, 0, $month, 1));
            $labaRugiPendapatan[] = 0;
            $labaRugiPengeluaran[] = 0;
        }

        foreach ($dataLabaRugi as $row) {
            $index = $monthMapping[Carbon::parse($row->bulan)->isoFormat('MMMM')] - 1;
            $labaRugiPendapatan[$index] = $row->pendapatan;
            $labaRugiPengeluaran[$index] = $row->pengeluaran;
        }

        //Perubahan Modal
        $dataPerubahanModal =  PerubahanModal::where('id_user', $userId)
            ->select('id_jenis', \DB::raw('SUM(jumlah) as total'))
            ->groupBy('id_jenis')
            ->get();

        $labelspm = [];
        $values = [];

        foreach ($dataPerubahanModal as $item) {
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

        //Arus Kas & Card"
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
            'labaRugiLabels' => $labaRugiLabels,
            'labaRugiPendapatan' => $labaRugiPendapatan,
            'labaRugiPengeluaran' => $labaRugiPengeluaran,
            'neracaLabels' => $neracaLabels,
            'neracaAset' => $neracaAset,
            'neracaKewajiban' => $neracaKewajiban,
            'neracaEkuitas' => $neracaEkuitas,
            'labelspm' => $labelspm,
            'values' => $values,
        ]);
    }
}
