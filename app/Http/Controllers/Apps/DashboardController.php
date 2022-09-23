<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\TahunLulusChart;
use App\Charts\AktivitasAlumniChart;
use DB;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Tutorial;
use App\Models\KITSPeduli;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        //
        activity()->log('akses dahsboard');
        $title = 'Dashboard';
        $users = User::latest()->paginate(5);
        $kegiatans = Kegiatan::latest()->paginate(5);
        $total_alumni = User::where('status_akun','alumni')->count();
        $total_siswa = User::where('status_akun','siswa')->count();
        $tutorial_approved = Tutorial::where('status','4')->count();
        $kitspeduli = KITSPeduli::where('status','PAID')->sum('nominal');

        //Charts Tahun Lulus
        $tahun_lulus = DB::table('users')
        ->select('tahun_lulus', DB::raw('count(*) as total'))
        ->where('level','3')
        ->groupBy('tahun_lulus')
        ->pluck('total', 'tahun_lulus')->all();
        // Generate random colours for the groups
        for ($i=0; $i<=count($tahun_lulus); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        // Prepare the data for returning with the view
        $chart_tahun_lulus = new TahunLulusChart;
        $chart_tahun_lulus->labels = (array_keys($tahun_lulus));
        $chart_tahun_lulus->dataset = (array_values($tahun_lulus));
        $chart_tahun_lulus->colours = $colours;

        //Charts Alumni Bekerja
        $aktivitas_alumni = DB::table('users')
        ->select('aktivitas', DB::raw('count(*) as total'))
        ->where('level','3')
        ->groupBy('aktivitas')
        ->pluck('total', 'aktivitas')->all();
        // Generate random colours for the groups
        // for ($i=0; $i<=count($alumni_bekerja); $i++) {
        //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        // }
        // Prepare the data for returning with the view
        $chart_aktivitas_alumni = new AktivitasAlumniChart;
        $chart_aktivitas_alumni->labels = (array_keys($aktivitas_alumni));
        $chart_aktivitas_alumni->dataset = (array_values($aktivitas_alumni));
        //$chart_alumni_bekerja->colours = $colours;

        //saldo kits
        $awal = date('Y-m-01');
        $akhir = date('Y-m-d');
        $saldo = 0;
        $sisa_saldo = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_saldo = KITSPeduli::where('updated_at', 'LIKE', "%$tanggal%")->sum('nominal');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $saldo = $total_saldo - $total_pengeluaran;
            $sisa_saldo += $saldo;
        }


        if (auth()->user()->level == 1) {
            return view('dashboard.admin',compact('title','users','total_alumni','total_siswa','tutorial_approved','chart_tahun_lulus','chart_aktivitas_alumni','kitspeduli','saldo'));
        } elseif (auth()->user()->level == 2) {
            return view('pembina.index',compact('title','users','total_alumni','total_siswa','tutorial_approved','chart_tahun_lulus','chart_aktivitas_alumni','kitspeduli'));
        } elseif (auth()->user()->level == 3) {
             return view('alumni.index',compact('title','kegiatans','total_alumni','total_siswa','tutorial_approved','chart_tahun_lulus','chart_aktivitas_alumni','kitspeduli'));
        } else {
            return view('siswa.index',compact('title','kegiatans','total_alumni','total_siswa','tutorial_approved','chart_tahun_lulus','chart_aktivitas_alumni','kitspeduli'));
        }
    }
}
