<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class foto extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'judul_foto',
        'deskripsi_foto',
        'tanggal_unggah',
        'lokasi_file',
        'album_id',
        'user_id',
    ];

    public function sluggable(): array
    {
        return [
            'judul_foto' => [
                'source' => 'title'
            ]
        ];
    }
}