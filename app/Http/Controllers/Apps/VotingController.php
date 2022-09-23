<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\User;
use App\Models\Settings;
use Auth;
use PDF;

class VotingController extends Controller
{
    //
    public function pilihan()
    {
        $title = ' Voting';
        $candidate = Kandidat::paginate();
        return view('voting.index',compact('candidate','title'));
    }

    public function vote(Request $request, $id)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
       
        $user->kandidat_id = $request->get('kandidat_id');
        $user->status_voting = "SUDAH";
        $user->save();
        return redirect()->route('voting.pilihan')->with('status', 'Terima kasih telah melakukan voting !!!');
    }

    public function list_voter()
    {
        $title = ' List Pemilih';
        return view('voting.list',compact('title'));
    }

    public function data()
    {
        $users = User::orderBy('id', 'desc')->get();

        return datatables()
            ->of($users)
            ->addIndexColumn()
            ->make(true);
    }

    public function hasil()
    {
        $title = 'Hasil Voting';
        $candidates = Kandidat::with('user')->paginate(5);
        $jumlah = User::where('status_voting','SUDAH')->count();

        return view('voting.hasil',compact('candidates','jumlah','title'));
    }

    public function pdf()
    {
        $title = 'Hasil Voting';
        $setting = Settings::first();
        $candidates = Kandidat::with('user')->paginate(5);
        $jumlah = User::where('status_voting','SUDAH')->count();

        $pdf = PDF::loadView('voting.pdf', compact('candidates','jumlah','title','setting'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        
        return $pdf->setPaper('a4', 'landscape')->stream('rekapitulasi-'.date("Y-m-d h:iA"));
    }
}
