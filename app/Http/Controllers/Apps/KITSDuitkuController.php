<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Royryando\Duitku\Facades\Duitku;
use App\Models\KITSBerbagi;

class KITSDuitkuController extends Controller
{
    //
    public function index()
    {
        //
        $title = 'KITS Peduli';
        activity()->log('akses menu KITS Peduli');

        return view('kits-duitku.add',compact('title'));
    }

     public function postPayment(Request $request) 
     {

        $title = 'Pembayaran KITS Peduli';

        $nominal = (int)$request->input('nominal');
        $user = auth()->user();

        $transaksi = new KITSBerbagi();
        $transaksi->nama = $user->name;
        $transaksi->email = $user->email;
        $transaksi->nohp = $user->phone;
        $transaksi->nominal = $nominal;
        $transaksi->code = "kits-peduli_" . rand(99, 9999);
        $transaksi->save();

        $methods = Duitku::paymentMethods((int)$request->input('nominal'));

        // dd($methods);

        return view('kits-duitku.pay', compact('transaksi', 'methods','title'));
    }

     public function postPaymentMethod(Request $request) 
     {
        $transaksi = KITSBerbagi::find($request->input('id'));
        if (!$transaksi) abort(404);

        $method = $request->input('payment_method');
        
        $response = Duitku::createInvoice(
            $transaksi->code, 
            $transaksi->nominal, 
            $method, 'KITS Peduli', 
            $transaksi->nama, 
            $transaksi->email, 30);
        if (!$response['success']) {
            abort(400, $response['message']);
        }

        $transaksi->method = $method;
        $transaksi->duitku_ref = $response['reference'];
        $transaksi->payment_url = $response['payment_url'];
        $transaksi->save();

        return Redirect::to($transaksi->payment_url);
    }
}
