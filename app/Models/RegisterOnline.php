<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterOnline extends Model
{
    protected $table = 'register_online';

    protected $fillable = [
        'full_name',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'parent_phone',
        'parent_email',
        'is_approved',
    ];
}
