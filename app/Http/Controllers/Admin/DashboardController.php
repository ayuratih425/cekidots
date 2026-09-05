<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenAkip;
use App\Models\DokumenIki;
use App\Models\MonevAkumulasi;
use App\Models\MonevBulanan;
use App\Models\Slider;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('dashboard_stats', 300, function () {
            $row = DB::selectOne("
                SELECT
                    (SELECT COUNT(*) FROM surat_masuk) as total_surat,
                    (SELECT COUNT(*) FROM surat_masuk WHERE status = 'baru') as total_surat_baru,
                    (SELECT COUNT(*) FROM sliders WHERE status = 'aktif') as total_slider,
                    (SELECT COUNT(*) FROM dokumen_akip) as total_akip,
                    (SELECT COUNT(*) FROM dokumen_iki) as total_iki,
                    (SELECT COUNT(*) FROM monev_bulanan) as total_monev_bulanan,
                    (SELECT COUNT(*) FROM monev_akumulasi) as total_monev_akumulasi
            ");
            return (array) $row;
        });

        $surat_terbaru = SuratMasuk::orderByDesc('id')->limit(5)->get();

        $aktivitas = collect([
            ...SuratMasuk::orderByDesc('id')->limit(3)->get()->map(fn ($r) => ['type' => 'surat', 'id' => $r->id, 'deskripsi' => 'Surat baru dari '.$r->asal_instansi, 'waktu' => $r->tanggal_masuk]),
            ...DokumenAkip::orderByDesc('id')->limit(2)->get()->map(fn ($r) => ['type' => 'akip', 'id' => $r->id, 'deskripsi' => 'Dokumen AKIP: '.$r->judul, 'waktu' => $r->created_at]),
            ...DokumenIki::orderByDesc('id')->limit(2)->get()->map(fn ($r) => ['type' => 'iki', 'id' => $r->id, 'deskripsi' => 'Dokumen IKI: '.$r->judul, 'waktu' => $r->created_at]),
            ...Slider::orderByDesc('id')->limit(2)->get()->map(fn ($r) => ['type' => 'slider', 'id' => $r->id, 'deskripsi' => 'Slide: '.$r->judul, 'waktu' => $r->created_at]),
        ])->sortByDesc('waktu')->take(10)->values();

        return view('admin.dashboard', [
            'total_surat'           => $stats['total_surat'],
            'total_surat_baru'      => $stats['total_surat_baru'],
            'total_slider'          => $stats['total_slider'],
            'total_akip'            => $stats['total_akip'],
            'total_iki'             => $stats['total_iki'],
            'total_monev_bulanan'   => $stats['total_monev_bulanan'],
            'total_monev_akumulasi' => $stats['total_monev_akumulasi'],
            'surat_terbaru'         => $surat_terbaru,
            'aktivitas'             => $aktivitas,
        ]);
    }
}