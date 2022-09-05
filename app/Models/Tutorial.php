<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tutorial extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'tutorial';
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
                'source' => 'name_tutorial'
            ]
        ];
    }

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
