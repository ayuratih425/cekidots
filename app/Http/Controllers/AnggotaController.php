<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\FolderDokumen;
use App\Models\LogAktivitas;
use App\Models\UploadAnggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    private function folderScope($user)
    {
        return fn ($q) => $q->where('status', 'aktif')
            ->where(fn ($qq) => $qq->where('divisi', $user->divisi)->orWhere('divisi', 'Semua'));
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();

        // Folder sesuai divisi user
        $parents = FolderDokumen::with([
            'uploads' => fn ($q) => $q->with('user:id,nama_admin'),
            'children.uploads' => fn ($q) => $q->with('user:id,nama_admin'),
        ])
            ->whereNull('parent_id')
            ->where('status', 'aktif')
            ->where(fn ($q) => $q->where('divisi', $user->divisi)->orWhere('divisi', 'Semua'))
            ->orderBy('nama')->get();

        // Kumpulkan semua upload_id yang sudah diarsipkan
        $allUploadIds = $parents->flatMap(fn ($p) => $p->uploads->pluck('id')
            ->merge($p->children->flatMap(fn ($c) => $c->uploads->pluck('id'))))->unique();
        $sudahArsip = ArsipSurat::aktif()->whereIn('file_name',
            UploadAnggota::whereIn('id', $allUploadIds)->pluck('file_name')
        )->pluck('file_name')->unique();

        $uploadSelect = [];
        $total_dokumen = 0;
        foreach ($parents as $parent) {
            $uploadSelect[$parent->id] = $parent->nama;
            $total_dokumen += $parent->uploads->count();
            foreach ($parent->children as $child) {
                $uploadSelect[$child->id] = '— '.$child->nama;
                $total_dokumen += $child->uploads->count();
            }
        }

        $total_folder = $parents->count() + $parents->sum(fn ($p) => $p->children->count());
        $dokumen_saya = UploadAnggota::where('user_id', $user->id)->count();
        $arsip_saya   = ArsipSurat::aktif()->where('uploaded_by', $user->id)->latest('uploaded_at')->get();

        return view('anggota.dashboard', compact('parents', 'uploadSelect', 'total_dokumen', 'total_folder', 'dokumen_saya', 'sudahArsip', 'arsip_saya'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'folder_id' => 'required|exists:folder_dokumen,id',
            'judul' => 'required|string',
            'file_dokumen' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,webp,txt,zip,rar',
            'tanggal_upload' => 'required|date',
        ]);

        $folder = FolderDokumen::where('id', $request->folder_id)->where($this->folderScope($user))->first();
        abort_unless($folder, 403);

        $file = $request->file('file_dokumen');
        $file_name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->storeAs('uploads/anggota', $file_name, 'public');

        $tanggal = Carbon::parse($request->tanggal_upload);

        $upload = UploadAnggota::create([
            'user_id' => Auth::id(),
            'folder_id' => $folder->id,
            'judul' => $request->judul,
            'file_name' => $file_name,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'keterangan' => $request->keterangan,
            'tahun' => $tanggal->year,
            'bulan' => $tanggal->month,
            'tanggal_upload' => $request->tanggal_upload,
            'status' => 'aktif',
        ]);

        LogAktivitas::create([
            'user_id'   => Auth::id(),
            'upload_id' => $upload->id,
            'aksi'      => 'upload',
            'detail'    => $request->judul,
        ]);

        // Hapus cache home agar total dokumen di halaman publik ikut update
        Cache::forget('home_page_data');
        Cache::forget('dashboard_stats');
        Cache::forget('dashboard_aktivitas');

        return back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function arsipkan(Request $request, UploadAnggota $upload)
    {
        $user = Auth::user();
        // Pastikan upload milik user ini
        abort_unless($upload->user_id === $user->id, 403);

        $request->validate([
            'nomor_surat'   => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'jenis_surat'   => 'required|in:masuk,keluar,internal',
            'keterangan'    => 'nullable|string',
        ]);

        ArsipSurat::create([
            'divisi'        => $user->divisi,
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal'       => $upload->judul,
            'jenis_surat'   => $request->jenis_surat,
            'file_path'     => 'uploads/anggota/' . $upload->file_name,
            'file_name'     => $upload->file_name,
            'file_size'     => $upload->file_size,
            'uploaded_by'   => $user->id,
            'uploaded_at'   => now(),
            'keterangan'    => $request->keterangan ?? 'Diarsipkan dari upload: ' . $upload->judul,
            'is_deleted'    => false,
        ]);

        LogAktivitas::create([
            'user_id'   => $user->id,
            'upload_id' => $upload->id,
            'aksi'      => 'arsip',
            'detail'    => 'Diarsipkan: ' . $upload->judul,
        ]);

        Cache::forget('dashboard_stats');

        return back()->with('success', 'Dokumen "' . $upload->judul . '" berhasil diarsipkan ke Arsip Surat!');
    }

    public function hapusArsip(\App\Models\ArsipSurat $arsip)
    {
        $user = Auth::user();
        abort_unless($arsip->uploaded_by === $user->id, 403);

        Storage::disk('public')->delete($arsip->file_path);
        $arsip->update(['is_deleted' => true]);

        Cache::forget('dashboard_stats');

        return back()->with('success', 'Arsip "'.$arsip->perihal.'" berhasil dihapus!');
    }

    public function download(UploadAnggota $upload)
    {
        $user = Auth::user();
        $folder = $upload->folder;
        abort_unless($folder && in_array($folder->divisi, [$user->divisi, 'Semua']), 403);

        $path = 'uploads/anggota/'.$upload->file_name;
        if (!Storage::disk('public')->exists($path)) {
            return back()->with('error', 'File "'.$upload->judul.'" tidak ditemukan di server.');
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'upload_id' => $upload->id,
            'aksi' => 'unduh',
            'detail' => $upload->judul,
        ]);

        return Storage::disk('public')->download($path, $upload->judul.'.'.$upload->file_type);
    }
}
