<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoperasiActivity extends Model
{
    protected $table = 'koperasi_activity';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
    ];

    public function koperasi_activity_photos()
    {
        return $this->hasMany(KoperasiPhotoActivity::class);
    }
}
