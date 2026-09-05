<?php

namespace App\Http\Controllers;

use App\Models\DokumenAkip;
use App\Models\DokumenIki;
use App\Models\FolderDokumen;
use App\Models\IkuPdrb;
use App\Models\MonevBulanan;
use App\Models\Slider;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $pdrb_terbaru = IkuPdrb::orderBy('id', 'desc')->first();

        $slides        = Slider::where('status', 'aktif')->orderBy('urutan')->limit(6)->get();
        $surat_terbaru = SuratMasuk::orderBy('id', 'desc')->limit(5)->get();
        $total_surat   = Cache::remember('home_total_surat', 600, fn () => SuratMasuk::count());
        $total_akip    = Cache::remember('home_total_akip', 600, fn () => DokumenAkip::count());
        $total_iki     = Cache::remember('home_total_iki', 600, fn () => DokumenIki::count());
        $total_monev   = Cache::remember('home_total_monev', 600, fn () => MonevBulanan::count());
        $capaian_pdrb  = $pdrb_terbaru ? (float) $pdrb_terbaru->capaian : 0;

        return view('public.home', compact('slides', 'surat_terbaru', 'total_surat', 'total_akip', 'total_iki', 'total_monev', 'capaian_pdrb'));
    }
}
