<?php


namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\Psr7\str;

class Zuwinda
{

    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('ZUWINDA_URL');
    }

    public function apiCall($request){

        if ($request['method'] == 'post'){
            $response = Http::withHeaders($request['headers'])->post($this->baseUrl . $request['url'], $request['data']);
        }else{
            $response = Http::withHeaders($request['headers'])->get($this->baseUrl . $request['url'] . '?' . $request['query']);
        }

        if ($request['url'] == 'instances'){
            if ((boolean)$response['success'] && count($response['data']) > 0){
                $instanceIds = '';
                foreach ($response['data'] as $data){
                    if ((string)$data['status'] == '1' && (string)$data['whatsapp_status'] == '1'){
                        $instanceIds .= $data['instances_id'] . ';';
                    }
                }
                if ($instanceIds == ''){
                    Log::error("Instances not available");
                }else{
                    Log::error("Failed get instances");
                }
            }
        }
    }
}
