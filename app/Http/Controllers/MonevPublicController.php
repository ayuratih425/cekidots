<?php

namespace App\Http\Controllers;

use App\Models\MonevAkumulasi;
use App\Models\MonevBulanan;
use App\Traits\HitungPredikat;
use Illuminate\Support\Facades\Cache;

class MonevPublicController extends Controller
{
    use HitungPredikat;

    public function index()
    {
        $tahun_list  = ['2025', '2026', '2027', '2028', '2029', '2030'];
        $tahun_aktif = in_array(request('tahun'), $tahun_list) ? request('tahun') : $tahun_list[0];

        $bulan_list   = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $bulan_singkat = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $bulan_aktif  = in_array(request('bulan'), $bulan_list) ? request('bulan') : $bulan_list[0];
        $tab_aktif    = request('tab', 'bulanan');

        // Cache per kombinasi tahun+bulan selama 10 menit
        $data_bulanan   = MonevBulanan::where('tahun', $tahun_aktif)->where('bulan', $bulan_aktif)->orderBy('id')->get();
        $data_akumulasi = MonevAkumulasi::where('tahun', $tahun_aktif)->orderBy('id')->get();

        return view('public.monev', compact(
            'tahun_list', 'tahun_aktif',
            'bulan_list', 'bulan_singkat', 'bulan_aktif',
            'tab_aktif',
            'data_bulanan', 'data_akumulasi',
        ));
    }
}