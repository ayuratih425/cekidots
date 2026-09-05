<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDeleteSeeder extends Seeder
{
    const TAG = 'DUMMY_DATA';

    public function run(): void
    {
        // Hapus berdasarkan keterangan yang mengandung tag dummy
        DB::table('upload_anggota')->where('keterangan', 'like', '%' . self::TAG . '%')->delete();
        DB::table('folder_dokumen')->where('deskripsi', 'like', '%' . self::TAG . '%')->delete();
        DB::table('dokumen_akip')->where('deskripsi', 'like', '%' . self::TAG . '%')->delete();
        DB::table('dokumen_iki')->where('deskripsi', 'like', '%' . self::TAG . '%')->delete();
        DB::table('surat_masuk')->where('keterangan', 'like', '%' . self::TAG . '%')->delete();

        // Hapus users dummy (email domain @cekidot.test, bukan super_admin)
        DB::table('users')
            ->where('email', 'like', '%@cekidot.test')
            ->where('role', '!=', 'super_admin')
            ->delete();

        DB::table('arsip_surat')->where('keterangan', 'like', '%' . self::TAG . '%')->delete();

        // Hapus slider dummy (ditandai tag di deskripsi)
        DB::table('sliders')->where('deskripsi', 'like', '%' . self::TAG . '%')->delete();
        // Hapus slider dengan gambar dummy_slider_
        DB::table('sliders')->where('gambar', 'like', 'dummy_slider_%')->delete();

        // Hapus semua data IKU, Capaian, Monev (semua adalah dummy)
        DB::table('iku_pdrb')->truncate();
        DB::table('iku_penilaian')->truncate();
        DB::table('iku_wisatawan')->truncate();
        DB::table('iku_ekraf')->truncate();
        DB::table('capaian_program')->truncate();
        DB::table('monev_bulanan')->truncate();
        DB::table('monev_akumulasi')->truncate();

        $this->command->info('✅ Semua data dummy berhasil dihapus!');
    }
}
