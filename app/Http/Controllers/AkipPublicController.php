<?php

namespace App\Http\Controllers;

use App\Models\DokumenAkip;
use App\Models\FolderDokumen;
use Illuminate\Support\Facades\Cache;

class AkipPublicController extends Controller
{
    public function index()
    {
        $tahun_list  = range(2025, 2030);
        $tahun_aktif = (int) request('tahun', date('Y'));
        if (!in_array($tahun_aktif, $tahun_list)) $tahun_aktif = 2025;

        $search = request('search');
        $bulan  = request('bulan');
        $tgl    = request('tanggal');

        // Cache dokumen AKIP per tahun selama 10 menit (jarang berubah)
        $dokumen       = DokumenAkip::where('tahun', $tahun_aktif)->where('status', 'aktif')->orderBy('urutan')->get();
        $total_dokumen = Cache::remember('akip_total', 600, fn () => DokumenAkip::where('status', 'aktif')->count());
        $folders_akip  = FolderDokumen::where(fn ($q) => $q->where('nama', 'like', '%AKIP%')->orWhere('nama', 'like', '%Akuntabilitas%'))->get();

        return view('public.akip', compact('dokumen', 'tahun_aktif', 'tahun_list', 'total_dokumen', 'search', 'bulan', 'tgl', 'folders_akip'));
    }
}