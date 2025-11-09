<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoperasiPhotoActivity extends Model
{
    protected $table = 'koperasi_activity_photo';
    protected $fillable = ['koperasi_activity_id', 'path'];

    public function koperasi_activity()
    {
        return $this->belongsTo(KoperasiActivity::class);
    }
}
