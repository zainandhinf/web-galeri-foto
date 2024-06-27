<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentarfoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_id',
        'user_id',
        'isi_komentar',
        'tanggal_komentar',
    ];
}