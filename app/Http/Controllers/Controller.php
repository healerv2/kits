<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Tripay\Main;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $tripay;

    public function __construct()
    {
        $this->tripay = new Main(
            config('tripay.api_key'),
            config('tripay.private_key'),
            config('tripay.merchant_code'),
            '' // fill for sandbox mode, leave blank if in production mode
        );
    }
}
