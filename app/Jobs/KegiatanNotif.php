<?php

namespace App\Jobs;

use App\Models\Kegiatan;
use App\Services\ZuwindaRequestBuilder;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KegiatanNotif implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $kegiatan_id;

    public function __construct($kegiatan_id)
    {
        //
        $this->kegiatan_id = $kegiatan_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $kegiatan = Kegiatan::with('user')->where('id', $this->kegiatan_id)->first();
        if ($kegiatan) {
            $zuwinda = new ZuwindaRequestBuilder();
            $zuwinda->buildSendWhatsapp(env('WHATSAPP_GROUP_ID'), '
*Informasi Kegiatan Komunitas IT SMKN 1 Nglegok*

Nama Kegiatan: ' . $kegiatan->name_kegiatan . '
Tanggal Kegiatan : ' . Carbon::create($kegiatan->tanggal_kegiatan)->isoFormat('D MMMM Y') . '
Untuk rekan-rekan alumni dan anggota KITS dapat melihat detail informasi ini di web Komunitas IT SMKN 1 Nglegok.

Demikian atas perhatian dan kerjasamanya yang baik disampaikan terima kasih.
            ')->send();
        }
    }
}
