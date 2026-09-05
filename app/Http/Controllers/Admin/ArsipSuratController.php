<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $divisi_list = ['Kepegawaian', 'Program', 'Keuangan', 'Ekraf', 'Destinasi', 'Pemasaran', 'Sdm'];

        $query = ArsipSurat::aktif()->with('uploader')->latest('uploaded_at');

        if ($user->isAdminDivisi()) {
            $query->where('divisi', $user->divisi);
        } elseif ($request->filled('divisi')) {
            $query->where('divisi', $request->get('divisi'));
        }

        if ($request->filled('search')) {
            $keyword = $request->get('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('nomor_surat', 'like', "%{$keyword}%")
                    ->orWhere('perihal', 'like', "%{$keyword}%")
                    ->orWhere('keterangan', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_surat', $request->get('jenis'));
        }

        // Group by jenis_surat untuk tampilan explorer
        $arsipAll  = $query->get();
        $byJenis   = $arsipAll->groupBy('jenis_surat');
        $arsip     = $query->paginate(15)->withQueryString();

        $stats = ArsipSurat::aktif()
            ->when($user->isAdminDivisi(), fn ($q) => $q->where('divisi', $user->divisi))
            ->selectRaw("COUNT(*) as total, SUM(jenis_surat='masuk') as masuk, SUM(jenis_surat='keluar') as keluar, SUM(jenis_surat='internal') as internal")
            ->first();

        return view('admin.arsip-surat', [
            'arsip'         => $arsip,
            'byJenis'       => $byJenis,
            'divisi_list'   => $divisi_list,
            'totalArsip'    => $stats->total,
            'totalMasuk'    => $stats->masuk,
            'totalKeluar'   => $stats->keluar,
            'totalInternal' => $stats->internal,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nomor_surat'   => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'perihal'       => 'required|string|max:255',
            'jenis_surat'   => 'required|in:masuk,keluar,internal',
            'file_surat'    => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'keterangan'    => 'nullable|string',
        ]);

        $divisi = $user->isAdminDivisi() ? $user->divisi : $request->divisi;
        $file   = $request->file('file_surat');
        $folder = 'arsip/'.strtolower($divisi ?? 'umum');
        $filePath = $file->store($folder, 'public');

        ArsipSurat::create([
            'divisi'        => $divisi,
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal'       => $request->perihal,
            'jenis_surat'   => $request->jenis_surat,
            'file_path'     => $filePath,
            'file_name'     => $file->getClientOriginalName(),
            'file_size'     => $file->getSize(),
            'uploaded_by'   => $user->id,
            'uploaded_at'   => now(),
            'keterangan'    => $request->keterangan,
            'is_deleted'    => false,
        ]);

        // Hapus cache dashboard agar angka statistik langsung update
        Cache::forget('dashboard_stats');
        Cache::forget('dashboard_aktivitas');

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip surat berhasil diunggah!');
    }

    public function download(ArsipSurat $arsip)
    {
        $user = Auth::user();

        if ($user->isAdminDivisi() && $arsip->divisi !== $user->divisi) {
            abort(403, 'Akses ditolak.');
        }

        return Storage::disk('public')->download($arsip->file_path, $arsip->file_name);
    }

    public function destroy(Request $request)
    {
        $user  = Auth::user();
        $arsip = ArsipSurat::findOrFail($request->delete_id);

        if ($user->isAdminDivisi() && $arsip->divisi !== $user->divisi) {
            abort(403, 'Akses ditolak.');
        }

        Storage::disk('public')->delete($arsip->file_path);
        $arsip->update(['is_deleted' => true]);

        Cache::forget('dashboard_stats');

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip surat berhasil dihapus!');
    }

    public function cetak(Request $request)
    {
        $user  = Auth::user();
        $query = ArsipSurat::aktif()->with('uploader')->orderBy('uploaded_at');

        if ($user->isAdminDivisi()) {
            $query->where('divisi', $user->divisi);
        } elseif ($request->filled('divisi')) {
            $query->where('divisi', $request->get('divisi'));
        }

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_surat', [$request->get('dari'), $request->get('sampai')]);
        }

        // Batasi 500 data saat cetak — cegah server OOM kalau data ribuan
        $arsip      = $query->limit(500)->get();
        $divisiNama = $user->isAdminDivisi() ? $user->divisi : ($request->get('divisi') ?? 'Semua Divisi');

        return view('admin.arsip-cetak', compact('arsip', 'divisiNama'));
    }
}
