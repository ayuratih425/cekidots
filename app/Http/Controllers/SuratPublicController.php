<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class SuratPublicController extends Controller
{
    public function create()
    {
        return view('public.kirim-surat');
    }

    public function store(Request $request)
    {
        // Batasi 3x kirim surat per IP per 5 menit — cegah spam
        $key = 'kirim-surat:'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $detik = RateLimiter::availableIn($key);
            return back()->with('error', "Terlalu banyak pengiriman. Coba lagi dalam {$detik} detik.")->withInput();
        }

        $request->validate([
            'nomor_surat'   => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'asal'          => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'perihal'       => 'required|string|max:255',
            'file'          => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $file = $request->file('file');
        $file_name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->storeAs('uploads/surat', $file_name, 'public');

        SuratMasuk::create([
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'asal_instansi' => $request->asal,
            'nama_pengirim' => $request->nama_pengirim,
            'no_hp'         => $request->no_hp,
            'perihal'       => $request->perihal,
            'keterangan'    => $request->keterangan,
            'file_surat'    => $file_name,
            'ip_address'    => $request->ip(),
            'dibaca'        => false,
            'status'        => 'baru',
            'tanggal_masuk' => now(),
        ]);

        RateLimiter::hit($key, 300); // catat pengiriman, reset setelah 5 menit

        // Hapus cache dashboard agar notif surat baru langsung muncul
        Cache::forget('dashboard_stats');
        Cache::forget('dashboard_surat_terbaru');
        Cache::forget('dashboard_aktivitas');
        Cache::forget('home_page_data');

        return back()->with('success', 'Surat berhasil dikirim!');
    }
}