<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmmiLevelSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel ummi_levels.
     */
    public function run(): void
    {
        DB::table('ummi_levels')->insert([
            ['name' => 'Ummi Pra', 'description' => 'Pra-Tahsin (pengenalan huruf hijaiyah)'],
            ['name' => 'Ummi 1', 'description' => 'Dasar bacaan dan makharijul huruf'],
            ['name' => 'Ummi 2', 'description' => 'Penyempurnaan tajwid dasar'],
            ['name' => 'Ummi 3', 'description' => 'Kelancaran dan kefasihan bacaan'],
            ['name' => 'Ummi 4', 'description' => 'Penerapan hukum tajwid lanjutan'],
            ['name' => 'Ummi 5', 'description' => 'Tahfidz dasar dan pemantapan bacaan'],
            ['name' => 'Ummi 6', 'description' => 'Tahfidz lanjut dan murojaah'],
            ['name' => 'Ummi Tilawah', 'description' => 'Latihan tilawah dan tartil Al-Qur’an'],
            ['name' => 'Ummi Gharib', 'description' => 'Pembelajaran lafadz-lafadz gharib dalam Al-Qur’an'],
            ['name' => 'Ummi Tajwid', 'description' => 'Pendalaman ilmu tajwid lanjutan'],
        ]);
    }
}