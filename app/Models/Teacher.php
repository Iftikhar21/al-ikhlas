<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Tabel yang digunakan (opsional jika nama table sesuai plural dari model)
    protected $table = 'teachers';

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'name',
        'gender',
        'last_education',
        'position',
        'phone_number',
        'address',
        'foto',
    ];
}