<?php

namespace App\Http\Controllers;

use App\Models\DokumenIki;
use App\Models\FolderDokumen;
use Illuminate\Support\Facades\Cache;

class IkiPublicController extends Controller
{
    public function index()
    {
        $tahun_list  = range(2025, 2030);
        $tahun_aktif = (int) request('tahun', date('Y'));
        if (!in_array($tahun_aktif, $tahun_list)) $tahun_aktif = 2025;

        $search = request('search');
        $bulan  = request('bulan');
        $tgl    = request('tanggal');

        // Cache dokumen IKI per tahun selama 10 menit
        $dokumen       = DokumenIki::where('tahun', $tahun_aktif)->where('status', 'aktif')->orderBy('urutan')->get();
        $total_dokumen = Cache::remember('iki_total', 600, fn () => DokumenIki::where('status', 'aktif')->count());
        $folders_iki   = FolderDokumen::where(fn ($q) => $q->where('nama', 'like', '%IKI%')->orWhere('nama', 'like', '%Kinerja Individu%'))->get();

        return view('public.iki', compact('dokumen', 'tahun_aktif', 'tahun_list', 'total_dokumen', 'search', 'bulan', 'tgl', 'folders_iki'));
    }
}