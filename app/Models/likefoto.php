<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likefoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_id',
        'user_id',
        'tanggal_like',
    ];
}