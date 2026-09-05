<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    // Tag penanda semua data dummy — untuk hapus nanti
    const TAG = 'DUMMY_DATA';

    public function run(): void
    {
        $this->seedUsers();
        $this->seedFolderDokumen();
        $this->seedDokumenAkip();
        $this->seedDokumenIki();
        $this->seedUploadAnggota();
        $this->seedSuratMasuk();
        $this->seedSlider();
        $this->seedIkuPdrb();
        $this->seedIkuPenilaian();
        $this->seedIkuWisatawan();
        $this->seedIkuEkraf();
        $this->seedCapaianProgram();
        $this->seedMonevBulanan();
        $this->seedMonevAkumulasi();
        $this->seedArsipSurat();

        $this->command->info('✅ Semua data dummy berhasil dibuat!');
        $this->command->info('   Jalankan: php artisan db:seed --class=DummyDeleteSeeder untuk hapus semua data dummy.');
    }

    private function seedUsers(): void
    {
        $divisi = [
            ['enum' => 'Ekraf',     'label' => 'Ekonomi Kreatif'],
            ['enum' => 'Pemasaran', 'label' => 'Pemasaran'],
            ['enum' => 'Destinasi', 'label' => 'Destinasi'],
            ['enum' => 'Sdm',       'label' => 'Sumber Daya'],
        ];

        foreach ($divisi as $d) {
            DB::table('users')->insertOrIgnore([
                'username'   => 'dummy_admin_' . strtolower($d['enum']),
                'password'   => Hash::make('password123'),
                'nama_admin' => 'Admin ' . $d['label'],
                'email'      => 'dummy_admin_' . strtolower($d['enum']) . '@cekidot.test',
                'role'       => 'admin_divisi',
                'divisi'     => $d['enum'],
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $anggota = [
            ['Budi Santoso',    'budi_santoso',    'Ekraf'],
            ['Siti Rahayu',     'siti_rahayu',     'Ekraf'],
            ['Ahmad Fauzi',     'ahmad_fauzi',     'Pemasaran'],
            ['Dewi Lestari',    'dewi_lestari',    'Pemasaran'],
            ['Rizky Pratama',   'rizky_pratama',   'Destinasi'],
            ['Nurul Hidayah',   'nurul_hidayah',   'Destinasi'],
            ['Hendra Wijaya',   'hendra_wijaya',   'Sdm'],
            ['Fitri Handayani', 'fitri_handayani', 'Sdm'],
        ];

        foreach ($anggota as $a) {
            DB::table('users')->insertOrIgnore([
                'username'   => 'dummy_' . $a[1],
                'password'   => Hash::make('password123'),
                'nama_admin' => $a[0],
                'email'      => 'dummy_' . $a[1] . '@cekidot.test',
                'role'       => 'anggota',
                'divisi'     => $a[2],
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->line('  → Users (admin divisi + anggota) dibuat');
    }

    private function seedFolderDokumen(): void
    {
        $folders = [
            ['nama' => 'IKI - Bidang Ekraf',          'divisi' => 'Ekraf'],
            ['nama' => 'IKI - Bidang Pemasaran',       'divisi' => 'Pemasaran'],
            ['nama' => 'IKI - Bidang Destinasi',       'divisi' => 'Destinasi'],
            ['nama' => 'IKI - Bidang SDM',             'divisi' => 'Sdm'],
            ['nama' => 'AKIP - Laporan Kinerja 2025',  'divisi' => 'Semua'],
            ['nama' => 'AKIP - Rencana Strategis',     'divisi' => 'Semua'],
            ['nama' => 'AKIP - Perjanjian Kinerja',    'divisi' => 'Semua'],
            ['nama' => 'Kinerja Individu Q1 2025',     'divisi' => 'Semua'],
            ['nama' => 'Kinerja Individu Q2 2025',     'divisi' => 'Semua'],
        ];

        foreach ($folders as $f) {
            DB::table('folder_dokumen')->insert([
                'nama'       => $f['nama'],
                'deskripsi'  => 'Folder ' . $f['nama'] . ' [' . self::TAG . ']',
                'divisi'     => $f['divisi'],
                'status'     => 'aktif',
                'parent_id'  => null,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->line('  → Folder dokumen dibuat');
    }

    private function seedDokumenAkip(): void
    {
        $dokumen = [
            ['judul' => 'Laporan Kinerja Instansi Pemerintah (LKIP) 2025', 'tahun' => 2025, 'urutan' => 1],
            ['judul' => 'Rencana Strategis (Renstra) 2025-2030', 'tahun' => 2025, 'urutan' => 2],
            ['judul' => 'Perjanjian Kinerja Tahun 2025', 'tahun' => 2025, 'urutan' => 3],
            ['judul' => 'Rencana Kerja Tahunan (RKT) 2025', 'tahun' => 2025, 'urutan' => 4],
            ['judul' => 'Indikator Kinerja Utama (IKU) 2025', 'tahun' => 2025, 'urutan' => 5],
            ['judul' => 'Laporan Kinerja Instansi Pemerintah (LKIP) 2026', 'tahun' => 2026, 'urutan' => 1],
            ['judul' => 'Perjanjian Kinerja Tahun 2026', 'tahun' => 2026, 'urutan' => 2],
        ];

        foreach ($dokumen as $d) {
            DB::table('dokumen_akip')->insert([
                'judul'       => $d['judul'],
                'tahun'       => $d['tahun'],
                'urutan'      => $d['urutan'],
                'status'      => 'aktif',
                'deskripsi'   => 'Data dummy [' . self::TAG . ']',
                'tipe_konten' => 'file',
                'file_dokumen'=> 'dummy_akip_' . $d['urutan'] . '.pdf',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $this->command->line('  → Dokumen AKIP dibuat');
    }

    private function seedDokumenIki(): void
    {
        $dokumen = [
            ['judul' => 'Panduan Pengisian IKI 2025', 'tahun' => 2025, 'urutan' => 1],
            ['judul' => 'Template IKI Bidang Ekonomi Kreatif', 'tahun' => 2025, 'urutan' => 2],
            ['judul' => 'Template IKI Bidang Pemasaran', 'tahun' => 2025, 'urutan' => 3],
            ['judul' => 'Template IKI Bidang Destinasi', 'tahun' => 2025, 'urutan' => 4],
            ['judul' => 'Rekapitulasi IKI Semester I 2025', 'tahun' => 2025, 'urutan' => 5],
            ['judul' => 'Panduan Pengisian IKI 2026', 'tahun' => 2026, 'urutan' => 1],
            ['judul' => 'Template IKI 2026', 'tahun' => 2026, 'urutan' => 2],
        ];

        foreach ($dokumen as $d) {
            DB::table('dokumen_iki')->insert([
                'judul'       => $d['judul'],
                'tahun'       => $d['tahun'],
                'urutan'      => $d['urutan'],
                'status'      => 'aktif',
                'deskripsi'   => 'Data dummy [' . self::TAG . ']',
                'tipe_konten' => 'file',
                'file_dokumen'=> 'dummy_iki_' . $d['urutan'] . '.pdf',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $this->command->line('  → Dokumen IKI dibuat');
    }

    private function seedUploadAnggota(): void
    {
        $anggotaIds = DB::table('users')->where('username', 'like', 'dummy_%')->where('role', 'anggota')->pluck('id')->toArray();
        $folderIds  = DB::table('folder_dokumen')->where('deskripsi', 'like', '%' . self::TAG . '%')->pluck('id')->toArray();

        if (empty($anggotaIds) || empty($folderIds)) return;

        foreach ($anggotaIds as $userId) {
            foreach ([1, 2, 3] as $bulan) {
                $namaBulan = ['', 'Januari', 'Februari', 'Maret'][$bulan];
                DB::table('upload_anggota')->insert([
                    'user_id'       => $userId,
                    'folder_id'     => $folderIds[array_rand($folderIds)],
                    'judul'         => 'Laporan IKI ' . $namaBulan . ' 2025',
                    'file_name'     => 'dummy_upload_' . $userId . '_' . $bulan . '.pdf',
                    'file_type'     => 'pdf',
                    'file_size'     => rand(100000, 2000000),
                    'keterangan'    => 'Upload dummy [' . self::TAG . ']',
                    'tahun'         => 2025,
                    'bulan'         => $bulan,
                    'tanggal_upload'=> Carbon::now()->subMonths(4 - $bulan)->format('Y-m-d'),
                    'status'        => 'aktif',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }

        $this->command->line('  → Upload anggota dibuat');
    }

    private function seedSuratMasuk(): void
    {
        $instansi = [
            'Dinas Pariwisata Kota Palu',
            'Bappeda Provinsi Sulawesi Tengah',
            'Kementerian Pariwisata RI',
            'Dinas Kebudayaan Kabupaten Poso',
            'DPRD Provinsi Sulawesi Tengah',
            'Universitas Tadulako',
            'Bank Indonesia Perwakilan Sulteng',
            'Dinas Perdagangan Kota Palu',
        ];

        $perihal = [
            'Permohonan Data Kunjungan Wisatawan',
            'Undangan Rapat Koordinasi Pariwisata',
            'Permohonan Narasumber Seminar Ekraf',
            'Laporan Kegiatan Festival Budaya',
            'Permohonan Kerjasama Promosi Wisata',
            'Surat Rekomendasi Kegiatan',
            'Permohonan Izin Penggunaan Fasilitas',
            'Laporan Monitoring dan Evaluasi',
        ];

        foreach (range(1, 12) as $i) {
            DB::table('surat_masuk')->insert([
                'nomor_surat'   => 'B-' . str_pad($i, 3, '0', STR_PAD_LEFT) . '/DISPAR/2025',
                'tanggal_surat' => Carbon::now()->subDays(rand(1, 90)),
                'asal_instansi' => $instansi[($i - 1) % count($instansi)],
                'nama_pengirim' => 'Kepala ' . $instansi[($i - 1) % count($instansi)],
                'no_hp'         => '0812' . rand(10000000, 99999999),
                'perihal'       => $perihal[($i - 1) % count($perihal)],
                'keterangan'    => 'Data dummy [' . self::TAG . ']',
                'file_surat'    => 'dummy_surat_' . $i . '.pdf',
                'ip_address'    => '127.0.0.1',
                'dibaca'        => $i > 4,
                'status'        => $i <= 4 ? 'baru' : 'dibaca',
                'tanggal_masuk' => Carbon::now()->subDays(rand(1, 90)),
            ]);
        }

        $this->command->line('  → Surat masuk dibuat (4 baru, 8 dibaca)');
    }

    private function seedSlider(): void
    {
        $slides = [
            ['judul' => 'Selamat Datang di CEKIDOT',        'deskripsi' => 'Sistem Informasi Kinerja Dinas Pariwisata Sulteng'],
            ['judul' => 'Monitoring Kinerja Real-Time',      'deskripsi' => 'Pantau capaian program secara transparan'],
            ['judul' => 'Ekraf Sulawesi Tengah',             'deskripsi' => 'Mendorong pertumbuhan ekonomi kreatif daerah'],
            ['judul' => 'Wisatawan Nusantara & Mancanegara', 'deskripsi' => 'Data kunjungan wisatawan terupdate'],
            ['judul' => 'AKIP & IKI Terintegrasi',          'deskripsi' => 'Dokumen kinerja dalam satu platform'],
            ['judul' => 'Monev Renaksi 2025',               'deskripsi' => 'Monitoring dan evaluasi rencana aksi [' . self::TAG . ']'],
        ];

        foreach ($slides as $i => $s) {
            DB::table('sliders')->insert([
                'judul'      => $s['judul'],
                'deskripsi'  => $s['deskripsi'],
                'gambar'     => 'dummy_slider_' . ($i + 1) . '.jpg',
                'urutan'     => $i + 1,
                'status'     => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->line('  → Slider beranda dibuat');
    }

    private function seedIkuPdrb(): void
    {
        $kategori = ['Makan Minum', 'Ekraf', 'Wisatawan'];
        $tahun    = [2025, 2026];

        foreach ($tahun as $t) {
            foreach ($kategori as $k) {
                $target   = $k === 'Wisatawan' ? rand(800000, 1200000) : round(rand(200, 500) / 100, 2);
                $realitas = round($target * (rand(70, 110) / 100), 2);
                $capaian  = $target > 0 ? round(($realitas / $target) * 100, 2) : 0;

                DB::table('iku_pdrb')->insert([
                    'kategori'   => $k,
                    'tahun'      => $t,
                    'target'     => $target,
                    'realitas'   => $realitas,
                    'capaian'    => $capaian,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->line('  → IKU PDRB dibuat');
    }

    private function seedIkuPenilaian(): void
    {
        $data = [
            ['kategori' => 'Makan Minum', 'nama_kriteria' => 'Penyediaan Akomodasi dan Makan Minum', 'nilai' => 4521.50],
            ['kategori' => 'Makan Minum', 'nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 185432.75],
            ['kategori' => 'Ekraf', 'nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 185432.75],
            ['kategori' => 'Makan Minum', 'nama_kriteria' => 'Sumber Data', 'nilai' => 0, 'link_sumber' => 'https://bps.go.id'],
            ['kategori' => 'Ekraf', 'nama_kriteria' => 'Sumber Data', 'nilai' => 0, 'link_sumber' => 'https://bps.go.id'],
            ['kategori' => 'Wisatawan', 'nama_kriteria' => 'Sumber Data', 'nilai' => 0, 'link_sumber' => 'https://dispar.sultengprov.go.id'],
        ];

        foreach ($data as $d) {
            DB::table('iku_penilaian')->insert([
                'kategori'     => $d['kategori'],
                'tahun'        => '2025',
                'nama_kriteria'=> $d['nama_kriteria'],
                'nilai'        => $d['nilai'],
                'link_sumber'  => $d['link_sumber'] ?? null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->line('  → IKU Penilaian dibuat');
    }

    private function seedIkuWisatawan(): void
    {
        $kabkota = [
            'BANGGAI KEPULAUAN', 'BANGGAI', 'MOROWALI', 'POSO', 'DONGGALA',
            'TOLI-TOLI', 'BUOL', 'PARIGI MOUTONG', 'TOJO UNA-UNA', 'SIGI',
            'BANGGAI LAUT', 'MOROWALI UTARA', 'KOTA PALU',
        ];
        $bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $subkategori = ['Nusantara', 'Mancanegara'];

        foreach ($subkategori as $sub) {
            foreach ($kabkota as $kab) {
                $row = [
                    'kategori'   => 'Wisatawan',
                    'subkategori'=> $sub,
                    'tahun'      => '2025',
                    'kabkota'    => $kab,
                    'total'      => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $total = 0;
                foreach ($bulan as $b) {
                    $val = $sub === 'Nusantara' ? rand(500, 8000) : rand(10, 500);
                    $row[$b] = $val;
                    $total  += $val;
                }
                $row['total'] = $total;
                DB::table('iku_wisatawan')->insert($row);
            }
        }

        $this->command->line('  → IKU Wisatawan dibuat');
    }

    private function seedIkuEkraf(): void
    {
        $sektor = [
            'Industri Makanan dan Minuman (C.2)',
            'Industri Tekstil dan Pakaian Jadi (C.4)',
            'Industri Kulit, Barang dari Kulit, dan Alas Kaki (C.5)',
            'Industri Kayu, Barang dari Kayu dan Gabus (C.6)',
            'Industri Kertas dan Barang dari Kertas (C.7)',
            'Industri Furnitur (C.15)',
            'Penyediaan Makan Minum (I.2)',
            'Informasi dan Komunikasi (J)',
            'Jasa Perusahaan (M,N)',
            'Jasa Lainnya (R,S,T,U)',
        ];

        foreach ($sektor as $s) {
            $nilai_bps = round(rand(100, 5000) / 100, 2);
            $koofisien = round(rand(1, 99) / 100, 4);
            $jumlah    = round($nilai_bps * $koofisien * 1000000000, 2);

            DB::table('iku_ekraf')->insert([
                'kategori'          => 'Ekraf',
                'tahun'             => '2025',
                'sektor'            => $s,
                'koofisien'         => $koofisien,
                'nilai_bps'         => $nilai_bps,
                'jumlah_rp'         => $jumlah,
                'hasil_penjumlahan' => $jumlah,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        $this->command->line('  → IKU Ekraf dibuat');
    }

    private function seedCapaianProgram(): void
    {
        $data = [
            ['program' => 'Peningkatan Daya Tarik Destinasi Wisata', 'sasaran' => 'Meningkatnya kualitas destinasi wisata', 'indikator' => 'Jumlah destinasi wisata yang dikembangkan', 'pj' => 'Bidang Destinasi'],
            ['program' => 'Pengembangan Ekonomi Kreatif', 'sasaran' => 'Meningkatnya kontribusi ekraf terhadap PDRB', 'indikator' => 'Persentase kontribusi ekraf terhadap PDRB', 'pj' => 'Bidang Ekonomi Kreatif'],
            ['program' => 'Pemasaran Pariwisata', 'sasaran' => 'Meningkatnya jumlah kunjungan wisatawan', 'indikator' => 'Jumlah kunjungan wisatawan nusantara dan mancanegara', 'pj' => 'Bidang Pemasaran'],
            ['program' => 'Pengembangan SDM Pariwisata', 'sasaran' => 'Meningkatnya kompetensi SDM pariwisata', 'indikator' => 'Jumlah SDM pariwisata yang tersertifikasi', 'pj' => 'Bidang Sumber Daya'],
            ['program' => 'Tata Kelola Pemerintahan', 'sasaran' => 'Meningkatnya akuntabilitas kinerja', 'indikator' => 'Nilai SAKIP Dinas Pariwisata', 'pj' => 'Sekretariat'],
        ];

        foreach ($data as $d) {
            $target   = round(rand(80, 100), 2);
            $realisasi = round($target * (rand(65, 105) / 100), 2);
            $capaian  = $target > 0 ? round(($realisasi / $target) * 100, 2) : 0;

            DB::table('capaian_program')->insert([
                'program'         => $d['program'],
                'sasaran'         => $d['sasaran'],
                'indikator'       => $d['indikator'],
                'target'          => $target,
                'realisasi'       => $realisasi,
                'capaian'         => $capaian,
                'frekwensi'       => 'Tahunan',
                'sumber_data'     => 'Laporan Kinerja 2025',
                'penanggung_jawab'=> $d['pj'],
                'tahun'           => '2025',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }

        $this->command->line('  → Capaian Program dibuat');
    }

    private function seedMonevBulanan(): void
    {
        $subkegiatan = [
            ['sub' => 'Pengembangan Daya Tarik Wisata Alam', 'indikator' => 'Jumlah lokasi wisata alam yang dikembangkan'],
            ['sub' => 'Promosi Wisata Digital', 'indikator' => 'Jumlah konten promosi yang dipublikasikan'],
            ['sub' => 'Pelatihan Pemandu Wisata', 'indikator' => 'Jumlah pemandu wisata yang dilatih'],
            ['sub' => 'Festival Budaya Daerah', 'indikator' => 'Jumlah event budaya yang diselenggarakan'],
            ['sub' => 'Pengembangan Produk Ekraf', 'indikator' => 'Jumlah produk ekraf yang dikembangkan'],
        ];

        $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        foreach ($bulanList as $bulan) {
            foreach ($subkegiatan as $sk) {
                $target_ik  = rand(2, 10);
                $real_ik    = rand(0, $target_ik + 1);
                $cap_ik     = $target_ik > 0 ? round(($real_ik / $target_ik) * 100, 2) : 0;
                $target_keu = rand(50, 500) * 1000000;
                $real_keu   = rand(0, $target_keu);
                $cap_keu    = $target_keu > 0 ? round(($real_keu / $target_keu) * 100, 2) : 0;

                DB::table('monev_bulanan')->insert([
                    'tahun'            => '2025',
                    'bulan'            => $bulan,
                    'sub_kegiatan'     => $sk['sub'],
                    'indikator'        => $sk['indikator'],
                    'target_ik'        => $target_ik,
                    'target_keu'       => $target_keu,
                    'realisasi_ik'     => $real_ik,
                    'realisasi_keu'    => $real_keu,
                    'capaian_ik'       => $cap_ik,
                    'capaian_keu'      => $cap_keu,
                    'sumber_data'      => 'Laporan Bulanan',
                    'faktor_pendukung' => 'Dukungan anggaran memadai',
                    'faktor_penghambat'=> $real_ik < $target_ik ? 'Keterbatasan SDM' : '',
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        $this->command->line('  → Monev Bulanan dibuat');
    }

    private function seedMonevAkumulasi(): void
    {
        $subkegiatan = [
            ['sub' => 'Pengembangan Daya Tarik Wisata Alam', 'indikator' => 'Jumlah lokasi wisata alam yang dikembangkan'],
            ['sub' => 'Promosi Wisata Digital', 'indikator' => 'Jumlah konten promosi yang dipublikasikan'],
            ['sub' => 'Pelatihan Pemandu Wisata', 'indikator' => 'Jumlah pemandu wisata yang dilatih'],
            ['sub' => 'Festival Budaya Daerah', 'indikator' => 'Jumlah event budaya yang diselenggarakan'],
            ['sub' => 'Pengembangan Produk Ekraf', 'indikator' => 'Jumlah produk ekraf yang dikembangkan'],
        ];

        foreach ($subkegiatan as $sk) {
            $target_ik  = rand(20, 60);
            $real_ik    = rand(10, $target_ik);
            $cap_ik     = $target_ik > 0 ? round(($real_ik / $target_ik) * 100, 2) : 0;
            $target_keu = rand(500, 3000) * 1000000;
            $real_keu   = rand(0, $target_keu);
            $cap_keu    = $target_keu > 0 ? round(($real_keu / $target_keu) * 100, 2) : 0;
            $predikat   = $cap_ik >= 100 ? 'ISTIMEWA' : ($cap_ik >= 80 ? 'BAIK' : ($cap_ik >= 60 ? 'BUTUH PERBAIKAN' : 'KURANG'));

            DB::table('monev_akumulasi')->insert([
                'tahun'            => '2025',
                'sub_kegiatan'     => $sk['sub'],
                'indikator'        => $sk['indikator'],
                'target_ik'        => $target_ik,
                'target_keu'       => $target_keu,
                'realisasi_ik'     => $real_ik,
                'realisasi_keu'    => $real_keu,
                'capaian_ik'       => $cap_ik,
                'capaian_keu'      => $cap_keu,
                'predikat_ik'      => $predikat,
                'predikat_keu'     => $predikat,
                'status'           => 'aktif',
                'status_ik'        => $cap_ik >= 80 ? 'baik' : 'kurang',
                'status_keu'       => $cap_keu >= 80 ? 'baik' : 'kurang',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        $this->command->line('  → Monev Akumulasi dibuat');
    }

    private function seedArsipSurat(): void
    {
        $adminIds = DB::table('users')->where('username', 'like', 'dummy_admin_%')->pluck('id', 'divisi');
        $superAdminId = DB::table('users')->where('role', 'super_admin')->value('id') ?? 1;

        $data = [
            // Ekraf
            ['divisi'=>'Ekraf','nomor'=>'001/EKRAF/2025','perihal'=>'Undangan Pelatihan Batik Sulawesi Tengah','jenis'=>'masuk','hari'=>90],
            ['divisi'=>'Ekraf','nomor'=>'002/EKRAF/2025','perihal'=>'Laporan Kegiatan Pameran Ekraf 2025','jenis'=>'keluar','hari'=>75],
            ['divisi'=>'Ekraf','nomor'=>'003/EKRAF/2025','perihal'=>'Nota Dinas Koordinasi Program Ekraf','jenis'=>'internal','hari'=>60],
            ['divisi'=>'Ekraf','nomor'=>'004/EKRAF/2025','perihal'=>'Permohonan Data UMKM Kreatif','jenis'=>'masuk','hari'=>45],
            // Pemasaran
            ['divisi'=>'Pemasaran','nomor'=>'001/PEMAS/2025','perihal'=>'Undangan Festival Pariwisata Sulteng','jenis'=>'masuk','hari'=>85],
            ['divisi'=>'Pemasaran','nomor'=>'002/PEMAS/2025','perihal'=>'Laporan Promosi Digital Q1 2025','jenis'=>'keluar','hari'=>70],
            ['divisi'=>'Pemasaran','nomor'=>'003/PEMAS/2025','perihal'=>'Kerjasama Media Promosi Wisata','jenis'=>'masuk','hari'=>55],
            ['divisi'=>'Pemasaran','nomor'=>'004/PEMAS/2025','perihal'=>'Nota Dinas Rapat Evaluasi Pemasaran','jenis'=>'internal','hari'=>40],
            // Destinasi
            ['divisi'=>'Destinasi','nomor'=>'001/DEST/2025','perihal'=>'Permohonan Pengembangan Destinasi Wisata Alam','jenis'=>'masuk','hari'=>80],
            ['divisi'=>'Destinasi','nomor'=>'002/DEST/2025','perihal'=>'Laporan Kunjungan Wisatawan Q1 2025','jenis'=>'keluar','hari'=>65],
            ['divisi'=>'Destinasi','nomor'=>'003/DEST/2025','perihal'=>'Koordinasi Pembangunan Infrastruktur Wisata','jenis'=>'internal','hari'=>50],
            // Sdm
            ['divisi'=>'Sdm','nomor'=>'001/SDM/2025','perihal'=>'Undangan Bimtek Pemandu Wisata','jenis'=>'masuk','hari'=>78],
            ['divisi'=>'Sdm','nomor'=>'002/SDM/2025','perihal'=>'Laporan Sertifikasi SDM Pariwisata 2025','jenis'=>'keluar','hari'=>63],
            ['divisi'=>'Sdm','nomor'=>'003/SDM/2025','perihal'=>'Nota Dinas Rekrutmen Tenaga Ahli','jenis'=>'internal','hari'=>48],
        ];

        foreach ($data as $d) {
            $uploaderId = $adminIds[$d['divisi']] ?? $superAdminId;
            DB::table('arsip_surat')->insert([
                'divisi'        => $d['divisi'],
                'nomor_surat'   => $d['nomor'],
                'tanggal_surat' => Carbon::now()->subDays($d['hari'])->format('Y-m-d'),
                'perihal'       => $d['perihal'],
                'jenis_surat'   => $d['jenis'],
                'file_path'     => 'arsip/' . strtolower($d['divisi']) . '/dummy_arsip_' . $d['nomor'] . '.pdf',
                'file_name'     => 'dummy_arsip_' . str_replace('/', '_', $d['nomor']) . '.pdf',
                'file_size'     => rand(50000, 500000),
                'uploaded_by'   => $uploaderId,
                'uploaded_at'   => Carbon::now()->subDays($d['hari']),
                'keterangan'    => 'Data dummy [' . self::TAG . ']',
                'is_deleted'    => false,
                'created_at'    => Carbon::now()->subDays($d['hari']),
                'updated_at'    => Carbon::now()->subDays($d['hari']),
            ]);
        }

        $this->command->line('  → Arsip surat dibuat (14 arsip, 4 divisi)');
    }
}
