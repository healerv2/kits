<?php

namespace App\Http\Controllers\Apps;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\KITSBerbagi;
use Royryando\Duitku\Http\Controllers\DuitkuBaseController;

class KITSDuitkuCallbackController extends DuitkuBaseController
{
    //
    protected function onPaymentSuccess(string $orderId, string $productDetail, int $amount, string $paymentCode, ?string $shopeeUserHash, string $reference, ?string $additionalParam): void
    {
        $transaksi = KITSBerbagi::where('code', $orderId)->first();
        if (!$transaksi) return;
        $transaksi->paid = $amount;
        $transaksi->status = '00';
        $transaksi->save();
    }

    protected function onPaymentFailed(string $orderId, string $productDetail, int $amount, string $paymentCode, ?string $shopeeUserHash, string $reference, ?string $additionalParam): void
    {
        $transaksi = KITSBerbagi::where('code', $orderId)->first();
        if (!$transaksi) return;
        /*
         * Transaction failed, just delete
         */
        $transaksi->delete();
    }

    public function myReturnCallback() {

        $title = 'Terima Kasih';

        return view('terimakasih',compact('title'));
    }
}
