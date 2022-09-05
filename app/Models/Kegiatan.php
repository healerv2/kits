<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Kegiatan extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_kegiatan'
            ]
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
