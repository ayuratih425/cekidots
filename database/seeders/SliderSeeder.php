<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sliders')->truncate();
        DB::table('sliders')->insert([
            ['gambar' => '1785256060_Cekidot.png', 'judul' => 'Slide Utama', 'urutan' => 1, 'status' => 'aktif', 'created_at' => now()],
            ['gambar' => 'slide.png',               'judul' => 'Slide 1',     'urutan' => 2, 'status' => 'aktif', 'created_at' => now()],
            ['gambar' => 'slide2.png',              'judul' => 'Slide 2',     'urutan' => 3, 'status' => 'aktif', 'created_at' => now()],
            ['gambar' => 'slide3.png',              'judul' => 'Slide 3',     'urutan' => 4, 'status' => 'aktif', 'created_at' => now()],
        ]);
    }
}
