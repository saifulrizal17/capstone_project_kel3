<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\CatatanKeuangan;
use App\Labarugi;
use App\PerubahanModal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $dataPerubahanModal = PerubahanModal::select('id_jenis', \DB::raw('SUM(jumlah) as total'))
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

        //Arus Kas
        $incomeAll = CatatanKeuangan::where('id_jenis', 1)->sum('jumlah');
        $expenseAll = CatatanKeuangan::where('id_jenis', 2)->sum('jumlah');
        $balanceAll = $incomeAll - $expenseAll;

        //Card"
        $totalUsers = User::count();
        $totalActiveUsers = User::where('is_active', true)->count();
        $totalDieUsers = User::where('is_active', false)->count();
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
            'totalDieUsers' => $totalDieUsers,
            'totalAdmins' => $totalAdmins,
            'totalUsers' => $totalUsers,
            'totalVisitors' => $totalVisitors,
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
