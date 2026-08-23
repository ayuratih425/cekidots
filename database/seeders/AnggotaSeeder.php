<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            ['username' => 'siti', 'nama_admin' => 'Siti Aminah', 'email' => 'siti@dispar.com', 'divisi' => 'Kepegawaian'],
            ['username' => 'andi', 'nama_admin' => 'Andi Pratama', 'email' => 'andi@dispar.com', 'divisi' => 'Program'],
            ['username' => 'dewi', 'nama_admin' => 'Dewi Lestari', 'email' => 'dewi@dispar.com', 'divisi' => 'Keuangan'],
            ['username' => 'rudi', 'nama_admin' => 'Rudi Hartono', 'email' => 'rudi@dispar.com', 'divisi' => 'Ekraf'],
            ['username' => 'maya', 'nama_admin' => 'Maya Sari', 'email' => 'maya@dispar.com', 'divisi' => 'Destinasi'],
        ];

        foreach ($anggota as $a) {
            User::updateOrCreate(
                ['username' => $a['username']],
                [
                    'nama_admin' => $a['nama_admin'],
                    'email' => $a['email'],
                    'password' => 'password123',
                    'role' => 'anggota',
                    'divisi' => $a['divisi'],
                ]
            );
        }
    }
}