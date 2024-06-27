<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_location',
        'album_id',
    ];
}