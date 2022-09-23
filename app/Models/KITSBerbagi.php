<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KITSBerbagi extends Model
{
    use HasFactory;
    protected $table = 'kitsberbagi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
         'nominal' => 'integer',
        'paid' => 'integer',
    ];
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('d-m-Y H:i:s');
    // }
}
