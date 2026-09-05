<?php

namespace App\Http\Controllers;

use App\Models\IkuEkraf;
use App\Models\IkuInfografis;
use App\Models\IkuPdrb;
use App\Models\IkuPenilaian;
use App\Models\IkuWisatawan;
use App\Traits\HitungPredikat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class IkuPublicController extends Controller
{
    use HitungPredikat;

    public function index()
    {
        $kategori_list    = ['Makan Minum', 'Wisatawan', 'Ekraf'];
        $kategori_aktif   = in_array(request('kategori'), $kategori_list) ? request('kategori') : 'Makan Minum';
        $tahun_list       = ['2025', '2026', '2027', '2028', '2029', '2030'];
        $tahun_aktif      = in_array(request('tahun'), $tahun_list) ? request('tahun') : '2025';
        $subkategori_list = ['Nusantara', 'Mancanegara', 'Akumulasi'];
        $subkategori_wisata = in_array(request('sub'), $subkategori_list) ? request('sub') : 'Nusantara';

        $wisatawan_kabkota = [
            'BANGGAI KEPULAUAN', 'BANGGAI', 'MOROWALI', 'POSO', 'DONGGALA',
            'TOLI-TOLI', 'BUOL', 'PARIGI MOUTONG', 'TOJO UNA-UNA', 'SIGI',
            'BANGGAI LAUT', 'MOROWALI UTARA', 'KOTA PALU',
        ];

        // Cache per kombinasi kategori+tahun+sub selama 10 menit
        $cacheKey = "iku_{$kategori_aktif}_{$tahun_aktif}_{$subkategori_wisata}";
        $data = Cache::remember($cacheKey, 600, function () use ($kategori_aktif, $tahun_aktif, $subkategori_wisata, $wisatawan_kabkota) {
            return $this->loadIkuData($kategori_aktif, $tahun_aktif, $subkategori_wisata, $wisatawan_kabkota);
        });

        return view('public.iku', array_merge($data, compact(
            'kategori_list', 'kategori_aktif',
            'tahun_list', 'tahun_aktif',
            'subkategori_wisata', 'subkategori_list',
            'wisatawan_kabkota'
        )));
    }

    private function loadIkuData(string $kategori, string $tahun, string $sub, array $kabkota): array
    {
        $kriteria = $ekraf_data = $wisatawan_data = [];
        $nilai1 = $nilai2 = $hasil = $total_ekraf = $pdrb_adhb_ekraf = $proporsi_ekraf = 0;
        $total_nusantara = $total_mancanegara = 0;

        if ($kategori === 'Makan Minum' || $kategori === 'Ekraf') {
            $kriteria = IkuPenilaian::where('kategori', $kategori)
                ->where('tahun', $tahun)
                ->whereNotIn('nama_kriteria', ['Sumber Data', 'Infografis'])
                ->orderBy('id')->get()->toArray();

            if (empty($kriteria)) {
                $kriteria = $kategori === 'Ekraf'
                    ? [['nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 0]]
                    : [['nama_kriteria' => 'Penyediaan Akomodasi dan Makan Minum', 'nilai' => 0], ['nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 0]];
            }
        }

        if ($kategori === 'Ekraf') {
            $ekraf_data = IkuEkraf::where('kategori', $kategori)->where('tahun', $tahun)
                ->orderBy('id')->limit(10)->get()->toArray();

            if (empty($ekraf_data)) {
                foreach (['Industri Makanan dan Minuman (C.2)', 'Industri Tekstil dan Pakaian Jadi (C.4)', 'Industri Kulit, Barang dari Kulit, dan Alas Kaki (C.5)', 'Industri Kayu, Barang dari Kayu dan Gabus; dan Barang Anyaman dari Bambu, Rotan, dan Sejenisnya (C.6)', 'Industri Kertas dan Barang dari Kertas; Percetakan dan Reproduksi Media Rekaman (C.7)', 'Industri Furnitur (C.15)', 'Penyediaan Makan Minum (I.2)', 'Informasi dan Komunikasi (J)', 'Jasa Perusahaan (M,N)', 'Jasa Lainnya (R,S,T,U)'] as $sektor) {
                    $ekraf_data[] = ['sektor' => $sektor, 'koofisien' => 0, 'nilai_bps' => 0, 'jumlah_rp' => 0, 'hasil_penjumlahan' => 0];
                }
            }
        }

        if ($kategori === 'Wisatawan') {
            $wisatawan_data = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', $sub)->where('tahun', $tahun)
                ->orderBy('id')->get()->toArray();

            if (empty($wisatawan_data)) {
                $bulan_keys = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
                foreach ($kabkota as $kab) {
                    $wisatawan_data[] = array_merge(['kabkota' => $kab, 'total' => 0], array_fill_keys($bulan_keys, 0));
                }
            }
        }

        $infografis        = IkuInfografis::where('kategori', $kategori)->first();
        $infografis_file   = $infografis?->file_name ?? '';
        $infografis_exists = $infografis && !empty($infografis->file_name) && Storage::disk('public')->exists('uploads/iku/'.$kategori.'/'.$infografis->file_name);

        $sumber      = IkuPenilaian::where('kategori', $kategori)->where('nama_kriteria', 'Sumber Data')->first();
        $sumber_data = $sumber ? $sumber->toArray() : ['link_sumber' => '', 'file_sumber' => ''];

        $pdrb_data = IkuPdrb::where('kategori', $kategori)->where('tahun', $tahun)->first();
        $pdrb      = $pdrb_data ? $pdrb_data->toArray() : ['target' => 0, 'realitas' => 0, 'capaian' => 0];

        if ($kategori === 'Ekraf') {
            foreach ($ekraf_data as $e) { $total_ekraf += (float) $e['hasil_penjumlahan']; }
            foreach ($kriteria as $k) {
                if ($k['nama_kriteria'] === 'PDRB ADHB Sulawesi Tengah') { $pdrb_adhb_ekraf = (float) $k['nilai']; }
            }
            if ($pdrb_adhb_ekraf > 0) {
                $proporsi_ekraf = round(($total_ekraf / ($pdrb_adhb_ekraf * 1000000000)) * 100, 4);
            }
            $nilai1 = $total_ekraf; $nilai2 = $pdrb_adhb_ekraf; $hasil = $proporsi_ekraf;
        } elseif ($kategori === 'Wisatawan') {
            $total_nusantara   = IkuWisatawan::where('kategori', 'Wisatawan')->where('subkategori', 'Nusantara')->where('tahun', $tahun)->sum('total');
            $total_mancanegara = IkuWisatawan::where('kategori', 'Wisatawan')->where('subkategori', 'Mancanegara')->where('tahun', $tahun)->sum('total');
            $nilai1 = $total_nusantara; $nilai2 = $total_mancanegara; $hasil = $total_nusantara + $total_mancanegara;
        } else {
            if (count($kriteria) >= 2) { $nilai1 = (float) $kriteria[0]['nilai']; $nilai2 = (float) $kriteria[1]['nilai']; }
            if ($nilai2 > 0) { $hasil = round(($nilai1 / $nilai2) * 100, 4); }
        }

        $target_db = (float) $pdrb['target'];
        $capaian   = $target_db > 0 ? round(($hasil / $target_db) * 100, 2) : 0;

        $bulan_keys       = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $total_bulan      = array_fill_keys($bulan_keys, 0);
        $total_keseluruhan = 0;
        if ($kategori === 'Wisatawan') {
            foreach ($wisatawan_data as $w) {
                foreach ($bulan_keys as $key) { $total_bulan[$key] += (float) $w[$key]; }
                $total_keseluruhan += (float) $w['total'];
            }
        }

        $akumulasi_data = [];
        if ($kategori === 'Wisatawan' && $sub === 'Akumulasi') {
            $data_nusantara   = IkuWisatawan::where('kategori', 'Wisatawan')->where('subkategori', 'Nusantara')->where('tahun', $tahun)->orderBy('id')->get();
            $data_mancanegara = IkuWisatawan::where('kategori', 'Wisatawan')->where('subkategori', 'Mancanegara')->where('tahun', $tahun)->orderBy('id')->get();
            foreach ($kabkota as $index => $kab) {
                $akumulasi_data[] = ['kabkota' => $kab, 'nusantara' => $data_nusantara[$index] ?? null, 'mancanegara' => $data_mancanegara[$index] ?? null];
            }
        }

        $capaian_formatted = number_format($capaian, 2, ',', '.');

        return [
            'kriteria'                => $kriteria,
            'ekraf_data'              => $ekraf_data,
            'wisatawan_data'          => $wisatawan_data,
            'infografis_file'         => $infografis_file,
            'infografis_exists'       => $infografis_exists,
            'sumber_data'             => $sumber_data,
            'nilai1_formatted'        => $kategori !== 'Wisatawan' ? number_format($nilai1, 2, ',', '.') : number_format($nilai1, 0, ',', '.'),
            'nilai2_formatted'        => $kategori !== 'Wisatawan' ? number_format($nilai2, 2, ',', '.') : number_format($nilai2, 0, ',', '.'),
            'hasil_formatted'         => number_format($hasil, 4, ',', '.'),
            'capaian_formatted'       => $capaian_formatted,
            'target_formatted'        => $kategori === 'Wisatawan' ? number_format($target_db, 0, ',', '.') : number_format($target_db, 2, ',', '.'),
            'total_ekraf_formatted'   => number_format($total_ekraf / 1000000000, 2, ',', '.'),
            'pdrb_adhb_ekraf_display' => number_format($pdrb_adhb_ekraf, 2, ',', '.'),
            'proporsi_ekraf_formatted'=> number_format($proporsi_ekraf, 3, ',', '.'),
            'predikat'                => $this->getPredikat($capaian_formatted),
            'bulan_keys'              => $bulan_keys,
            'total_bulan'             => $total_bulan,
            'total_keseluruhan'       => $total_keseluruhan,
            'total_nusantara'         => $total_nusantara,
            'total_mancanegara'       => $total_mancanegara,
            'akumulasi_data'          => $akumulasi_data,
        ];
    }
}
/*
        $kategori_aktif = request('kategori', 'Makan Minum');
        
        $tahun_list = ['2025', '2026', '2027', '2028', '2029', '2030'];
        $tahun_aktif = request('tahun', '2025');
        
        $subkategori_wisata = request('sub', 'Nusantara');
        $subkategori_list = ['Nusantara', 'Mancanegara', 'Akumulasi'];
        
        $kriteria = [];
        $ekraf_data = [];
        $wisatawan_data = [];
        $wisatawan_kabkota = [
            'BANGGAI KEPULAUAN', 'BANGGAI', 'MOROWALI', 'POSO', 'DONGGALA',
            'TOLI-TOLI', 'BUOL', 'PARIGI MOUTONG', 'TOJO UNA-UNA', 'SIGI',
            'BANGGAI LAUT', 'MOROWALI UTARA', 'KOTA PALU'
        ];
        
        if ($kategori_aktif == 'Makan Minum') {
            $kriteria = IkuPenilaian::where('kategori', $kategori_aktif)
                ->where('tahun', $tahun_aktif)
                ->whereNotIn('nama_kriteria', ['Sumber Data', 'Infografis'])
                ->orderBy('id')
                ->get()
                ->toArray();
                
            if (empty($kriteria)) {
                $kriteria = [
                    ['nama_kriteria' => 'Penyediaan Akomodasi dan Makan Minum', 'nilai' => 0],
                    ['nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 0]
                ];
            }
        } elseif ($kategori_aktif == 'Ekraf') {
            $kriteria = IkuPenilaian::where('kategori', $kategori_aktif)
                ->where('tahun', $tahun_aktif)
                ->whereNotIn('nama_kriteria', ['Sumber Data', 'Infografis'])
                ->orderBy('id')
                ->get()
                ->toArray();
                
            if (empty($kriteria)) {
                $kriteria = [
                    ['nama_kriteria' => 'PDRB ADHB Sulawesi Tengah', 'nilai' => 0]
                ];
            }
            
            $ekraf_data = IkuEkraf::where('kategori', $kategori_aktif)
                ->where('tahun', $tahun_aktif)
                ->orderBy('id')
                ->limit(10)
                ->get()
                ->toArray();
                
            if (empty($ekraf_data)) {
                $sektor_list = [
                    'Industri Makanan dan Minuman (C.2)',
                    'Industri Tekstil dan Pakaian Jadi (C.4)',
                    'Industri Kulit, Barang dari Kulit, dan Alas Kaki (C.5)',
                    'Industri Kayu, Barang dari Kayu dan Gabus; dan Barang Anyaman dari Bambu, Rotan, dan Sejenisnya (C.6)',
                    'Industri Kertas dan Barang dari Kertas; Percetakan dan Reproduksi Media Rekaman (C.7)',
                    'Industri Furnitur (C.15)',
                    'Penyediaan Makan Minum (I.2)',
                    'Informasi dan Komunikasi (J)',
                    'Jasa Perusahaan (M,N)',
                    'Jasa Lainnya (R,S,T,U)'
                ];
                foreach ($sektor_list as $sektor) {
                    $ekraf_data[] = [
                        'sektor' => $sektor,
                        'koofisien' => 0,
                        'nilai_bps' => 0,
                        'jumlah_rp' => 0,
                        'hasil_penjumlahan' => 0
                    ];
                }
            }
        } elseif ($kategori_aktif == 'Wisatawan') {
            $wisatawan_data = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', $subkategori_wisata)
                ->where('tahun', $tahun_aktif)
                ->orderBy('id')
                ->get()
                ->toArray();
                
            if (empty($wisatawan_data)) {
                foreach ($wisatawan_kabkota as $kab) {
                    $wisatawan_data[] = [
                        'kabkota' => $kab,
                        'januari' => 0, 'februari' => 0, 'maret' => 0, 'april' => 0,
                        'mei' => 0, 'juni' => 0, 'juli' => 0, 'agustus' => 0,
                        'september' => 0, 'oktober' => 0, 'november' => 0, 'desember' => 0,
                        'total' => 0
                    ];
                }
            }
        }
        
        // Infografis
        $infografis = IkuInfografis::where('kategori', $kategori_aktif)->first();
        $infografis_file = $infografis ? $infografis->file_name : '';
        $infografis_exists = $infografis && !empty($infografis->file_name) && Storage::disk('public')->exists('uploads/iku/' . $kategori_aktif . '/' . $infografis->file_name);
        
        // Sumber data
        $sumber = IkuPenilaian::where('kategori', $kategori_aktif)
            ->where('nama_kriteria', 'Sumber Data')
            ->first();
        $sumber_data = $sumber ? $sumber->toArray() : ['link_sumber' => '', 'file_sumber' => ''];
        
        // PDRB data
        $pdrb_data = IkuPdrb::where('kategori', $kategori_aktif)
            ->where('tahun', $tahun_aktif)
            ->first();
        $pdrb = $pdrb_data ? $pdrb_data->toArray() : ['target' => 0, 'realitas' => 0, 'capaian' => 0];
        
        // Perhitungan
        $hasil = 0; $nilai1 = 0; $nilai2 = 0;
        $total_ekraf = 0; $pdrb_adhb_ekraf = 0; $proporsi_ekraf = 0;
        $total_nusantara = 0; $total_mancanegara = 0;
        
        if ($kategori_aktif == 'Ekraf') {
            foreach ($ekraf_data as $e) {
                $total_ekraf += (float) $e['hasil_penjumlahan'];
            }
            foreach ($kriteria as $k) {
                if ($k['nama_kriteria'] == 'PDRB ADHB Sulawesi Tengah') {
                    $pdrb_adhb_ekraf = (float) $k['nilai'];
                }
            }
            if ($pdrb_adhb_ekraf > 0) {
                $proporsi_ekraf = ($total_ekraf / ($pdrb_adhb_ekraf * 1000000000)) * 100;
                $proporsi_ekraf = round($proporsi_ekraf, 4);
            }
            $nilai1 = $total_ekraf;
            $nilai2 = $pdrb_adhb_ekraf;
            $hasil = $proporsi_ekraf;
        } elseif ($kategori_aktif == 'Wisatawan') {
            $total_nusantara = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', 'Nusantara')
                ->where('tahun', $tahun_aktif)
                ->sum('total');
            $total_mancanegara = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', 'Mancanegara')
                ->where('tahun', $tahun_aktif)
                ->sum('total');
            $nilai1 = $total_nusantara;
            $nilai2 = $total_mancanegara;
            $hasil = $total_nusantara + $total_mancanegara;
        } else {
            if (count($kriteria) >= 2) {
                $nilai1 = (float) $kriteria[0]['nilai'];
                $nilai2 = (float) $kriteria[1]['nilai'];
            }
            if ($nilai2 > 0) {
                $hasil = ($nilai1 / $nilai2) * 100;
                $hasil = round($hasil, 4);
            }
        }
        
        $target_db = (float) $pdrb['target'];
        $realitas = $hasil;
        $capaian = 0;
        if ($target_db > 0) {
            $capaian = ($realitas / $target_db) * 100;
            $capaian = round($capaian, 2);
        }
        
        // Format angka
        if ($kategori_aktif == 'Makan Minum' || $kategori_aktif == 'Ekraf') {
            $nilai1_formatted = number_format($nilai1, 2, ',', '.');
            $nilai2_formatted = number_format($nilai2, 2, ',', '.');
        } else {
            $nilai1_formatted = number_format($nilai1, 0, ',', '.');
            $nilai2_formatted = number_format($nilai2, 0, ',', '.');
        }
        
        $hasil_formatted = number_format($hasil, 4, ',', '.');
        $capaian_formatted = number_format($capaian, 2, ',', '.');
        
        if ($kategori_aktif == 'Wisatawan') {
            $target_formatted = number_format($target_db, 0, ',', '.');
        } else {
            $target_formatted = number_format($target_db, 2, ',', '.');
        }
        
        $total_ekraf_formatted = number_format($total_ekraf / 1000000000, 2, ',', '.');
        $pdrb_adhb_ekraf_display = number_format($pdrb_adhb_ekraf, 2, ',', '.');
        $proporsi_ekraf_formatted = number_format($proporsi_ekraf, 3, ',', '.');
        
        $predikat = $this->getPredikat($capaian_formatted);
        
        // Total per bulan untuk wisatawan
        $bulan_keys = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
        $total_bulan = [];
        $total_keseluruhan = 0;
        if ($kategori_aktif == 'Wisatawan') {
            foreach ($bulan_keys as $key) {
                $total_bulan[$key] = 0;
            }
            foreach ($wisatawan_data as $w) {
                foreach ($bulan_keys as $key) {
                    $total_bulan[$key] += (float) $w[$key];
                }
                $total_keseluruhan += (float) $w['total'];
            }
        }
        
        // Akumulasi data
        $akumulasi_data = [];
        if ($kategori_aktif == 'Wisatawan' && $subkategori_wisata == 'Akumulasi') {
            $data_nusantara = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', 'Nusantara')
                ->where('tahun', $tahun_aktif)
                ->orderBy('id')
                ->get();
            $data_mancanegara = IkuWisatawan::where('kategori', 'Wisatawan')
                ->where('subkategori', 'Mancanegara')
                ->where('tahun', $tahun_aktif)
                ->orderBy('id')
                ->get();
            
            foreach ($wisatawan_kabkota as $index => $kab) {
                $akumulasi_data[] = [
                    'kabkota' => $kab,
                    'nusantara' => $data_nusantara[$index] ?? null,
                    'mancanegara' => $data_mancanegara[$index] ?? null
                ];
            }
        }
        
        return view('public.iku', compact(
            'kategori_list', 'kategori_aktif',
            'tahun_list', 'tahun_aktif',
            'subkategori_wisata', 'subkategori_list',
            'kriteria', 'ekraf_data', 'wisatawan_data',
            'wisatawan_kabkota',
            'infografis_file', 'infografis_exists',
            'sumber_data',
            'nilai1_formatted', 'nilai2_formatted',
            'hasil_formatted', 'capaian_formatted',
            'target_formatted',
            'total_ekraf_formatted', 'pdrb_adhb_ekraf_display',
            'proporsi_ekraf_formatted',
            'predikat',
            'bulan_keys', 'total_bulan', 'total_keseluruhan',
            'total_nusantara', 'total_mancanegara',
            'akumulasi_data'
        ));
    }
}
*/