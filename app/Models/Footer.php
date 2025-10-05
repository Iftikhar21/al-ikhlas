<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'logo',
        'slogan',
        'deskripsi',
        'alamat',
        'telepon',
        'email',
        'map_embed'
    ];

    public function socials()
    {
        return $this->hasMany(FooterSocial::class, 'footer_id');
    }
}
