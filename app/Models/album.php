<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class album extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'nama_album',
        'deskripsi',
        'tanggal_dibuat',
        'user_id',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}