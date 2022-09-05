<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZuwindaRequestBuilder
{

    protected $token;
    protected $url;
    protected $query;
    protected $data;
    protected $headers;
    protected $instance_id;
    protected $method;

    public function __construct()
    {
        $this->token = env('ZUWINDA_TOKEN');
        $this->instance_id = env('ZUWINDA_INSTANCES_ID');
    }

    public function buildGetInstance(){
        $this->method = 'get';
        $this->url = 'instances';
        $this->headers = [
            'x-access-key' => $this->token
        ];
        return $this;
    }

    public function buildSendWhatsapp($to, $content){
        $this->method = 'get';
        $this->url = 'message/whatsapp/send-text';
        $this->query = 'token=' . $this->token . '&to=' . $to . '&content=' . $content . '&instances_id=' . $this->instance_id;
        $this->headers = [
            'x-access-key' => $this->token
        ];
        return $this;
    }

    public function send()
    {
        $zuwinda = new Zuwinda();
        $zuwinda->apiCall([
            'method' => $this->method,
            'url' => $this->url,
            'query' => $this->query,
            'data' => $this->data,
            'headers' => $this->headers,
        ]);
    }
}
