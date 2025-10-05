<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSocial extends Model
{
    protected $fillable = ['footer_id', 'platform', 'url'];

    public function footer()
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }
}
