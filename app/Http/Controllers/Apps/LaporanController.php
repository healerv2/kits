<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KITSPeduli;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = 'Data laporan';
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('laporan.index', compact('tanggalAwal', 'tanggalAkhir','title'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $saldo = 0;
        $sisa_saldo = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_saldo = KITSPeduli::where('updated_at', 'LIKE', "%$tanggal%")->sum('nominal');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $saldo = $total_saldo - $total_pengeluaran;
            $sisa_saldo += $saldo;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = tanggal_indonesia($tanggal, false);
            $row['pemasukan'] = format_uang($total_saldo);
            //$row['pembelian'] = format_uang($total_pembelian);
            $row['pengeluaran'] = format_uang($total_pengeluaran);
            $row['saldo'] = format_uang($saldo);

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'pemasukan' => '',
            // 'pembelian' => '',
            'pengeluaran' => 'Total Saldo',
            'saldo' => format_uang($sisa_saldo),
        ];

        return $data;
    }

    public function data($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        return datatables()
        ->of($data)
        ->make(true);
    }
}
