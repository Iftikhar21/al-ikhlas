<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kajian extends Model
{
    use HasFactory;
    protected $table = 'kajians';
    protected $fillable = [
        'judul',
        'materi',
        'pembicara',
        'jenis_kajian',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'keterangan',
        'poster',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
