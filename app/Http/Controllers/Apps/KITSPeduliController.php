<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Services\TripayService;
use Carbon\Carbon;
use App\Models\KITSPeduli;

class KITSPeduliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'KITS Peduli';
        $payment = new TripayService();
        $metode= $payment->getChannelsPayment();
        //$metode = $this->tripay->initChannelPembayaran()->getJson()[2]->payment;
        //dd($metode);
        activity()->log('akses menu KITS Peduli');

        return view('kits-peduli.add',compact('title','metode'));
    }

    public function list()
    {
        $title = 'List KITS Peduli';
        activity()->log('akses menu daftar KITS Peduli');

        return view('kits-peduli.index',compact('title'));
    }

    public function data()
    {
        $kitspeduli = KITSPeduli::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kitspeduli)
            ->addColumn('nominal', function ($kitspeduli) {
                return format_uang($kitspeduli->nominal);
            })
            ->addIndexColumn()
            ->addColumn('aksi', function ($kitspeduli) {
                return '
                <div class="btn-group">
                    <button onclick="deleteData(`'. route('kits-peduli.destroy', $kitspeduli->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
        $metode = $request->metode;
        $user = auth()->user();

        $transaksi = new KITSPeduli();
        $transaksi->nama = $user->name;
        $transaksi->email = $user->email;
        $transaksi->nohp = $user->phone;
        $transaksi->nominal = $request->nominal;
        $transaksi->invoice = "kits-peduli_" . rand(99, 9999);
        //$transaksi->metode = $request->metode;
        $transaksi->save();

        activity()->log('mengirim request ke tripay & menyimpan data ke database');

        $merchantRef = $transaksi->invoice;
        $init = $this->tripay->initTransaction($merchantRef);

        $init->setAmount($transaksi->nominal);

        $signature = $init->createSignature();

        $transaction = $init->closeTransaction();
        $transaction->setPayload([
            'method'            => $metode,
            'merchant_ref'      => $merchantRef,
            'amount'            => $init->getAmount(),
            'customer_name'     => $transaksi->nama,
            'customer_email'    => $transaksi->email,
            'customer_phone'    => $transaksi->nohp,
            'order_items'       => [
                [
                    'sku'       => 'DONASI',
                    'name'      => 'KITS PEDULI',
                    'price'     => $init->getAmount(),
                    'quantity'  => 1
                ]
            ],
            'callback_url'      => URL::to('/') . '/api/callback',
            //'callback_url'      => 'https://f725-125-166-9-247.ap.ngrok.io/api/callback',
            //'return_url'        => 'http://localhost:8000/kits-peduli/terima-kasih',
            'return_url'        => URL::to('/') . '/kits-peduli/terima-kasih',
            // 'expired_time'      => (time()+(24*60*60)), // 24 jam
            'expired_time'      => (time()+(30*60)),
            'signature'         => $init->createSignature()
        ]);

        $getPayload = $transaction->getPayload();
        $get_data_tripay = $transaction->getJson();
        return redirect($get_data_tripay->data->checkout_url);

        //return response()->json($transaction->getData());
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
        try {
            $kitspeduli = KITSPeduli::find($id);
            $kitspeduli->delete();
            activity()->log('hapus data kits peduli');
            return response()->json([
                'success' => true, 
                'message' => 'Data berhasil dihapus' 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. code 500'
            ]);
        }
    }

    public function callback(Request $request)
    {
        $init= $this->tripay->initCallback();
        $result = $init->getJson();

        if ($request->header("X-Callback-Event") != "payment_status") {
            die("access denied bestie!");
        }

        $transaksi = KITSPeduli::where('invoice', $result->merchant_ref)->first();
        if ($transaksi) {
            if($result->status == "PAID") {
                $transaksi->status = "PAID";
            }

            $transaksi->status = $result->status;
            $transaksi->updated_at = Carbon::now();
            $transaksi->update();

            return response()->json($transaksi);
        }

        return response()->json([
                'success' => false,
                'message' => 'Maaf! transaksi tidak ditemukan'
            ]);

        //return response() -> json($result);
    }

    public function thx()
    {
        $title = 'Terima Kasih KITS Peduli';
        activity()->log('akses page Terima kasih KITS Peduli');

        return view('kits-peduli.terimakasih',compact('title'));
    }
}
