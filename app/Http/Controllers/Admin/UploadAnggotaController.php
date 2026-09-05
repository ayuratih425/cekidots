<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipSurat;
use App\Models\FolderDokumen;
use App\Models\LogAktivitas;
use App\Models\SuratMasuk;
use App\Models\UploadAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = UploadAnggota::with(['user', 'folder']);

        if ($user->isAdminDivisi()) {
            $query->whereHas('user', fn ($q) => $q->where('divisi', $user->divisi));
        }

        if ($request->filled('search')) {
            $query->where(fn ($q) => $q->where('judul', 'like', '%'.$request->search.'%')
                ->orWhereHas('user', fn ($q2) => $q2->where('nama_admin', 'like', '%'.$request->search.'%')));
        }
        if ($request->filled('folder_id')) {
            $query->where('folder_id', $request->folder_id);
        }
        if ($request->filled('divisi')) {
            $query->whereHas('user', fn ($q) => $q->where('divisi', $request->divisi));
        }
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        $uploads = $query->orderByDesc('tanggal_upload')->paginate(20)->withQueryString();
        $folders = FolderDokumen::orderBy('nama')->get();
        $total_baru = SuratMasuk::where('status', 'baru')->count();
        $divisi_list = ['Kepegawaian', 'Program', 'Keuangan', 'Ekraf', 'Destinasi', 'Pemasaran', 'Sdm'];

        return view('admin.upload-anggota', compact('uploads', 'folders', 'total_baru', 'divisi_list'));
    }

    public function arsipkan(Request $request, UploadAnggota $upload)
    {
        $request->validate([
            'nomor_surat'   => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'jenis_surat'   => 'required|in:masuk,keluar,internal',
            'keterangan'    => 'nullable|string',
        ]);

        $user   = Auth::user();
        $divisi = $upload->user->divisi ?? ($user->isAdminDivisi() ? $user->divisi : $request->divisi);

        ArsipSurat::create([
            'divisi'        => $divisi,
            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal'       => $upload->judul,
            'jenis_surat'   => $request->jenis_surat,
            'file_path'     => 'uploads/anggota/' . $upload->file_name,
            'file_name'     => $upload->file_name,
            'file_size'     => $upload->file_size,
            'uploaded_by'   => $user->id,
            'uploaded_at'   => now(),
            'keterangan'    => $request->keterangan ?? 'Diarsipkan dari upload anggota: ' . $upload->judul,
            'is_deleted'    => false,
        ]);

        LogAktivitas::create([
            'user_id'   => $user->id,
            'upload_id' => $upload->id,
            'aksi'      => 'arsip',
            'detail'    => 'Diarsipkan: ' . $upload->judul,
        ]);

        return back()->with('success', 'Dokumen "' . $upload->judul . '" berhasil diarsipkan!');
    }

    public function download(UploadAnggota $upload)
    {
        LogAktivitas::create([
            'user_id'  => Auth::id(),
            'upload_id'=> $upload->id,
            'aksi'     => 'unduh',
            'detail'   => $upload->judul,
        ]);

        return Storage::disk('public')->download(
            'uploads/anggota/'.$upload->file_name,
            $upload->judul.'.'.$upload->file_type
        );
    }

    public function destroy(UploadAnggota $upload)
    {
        LogAktivitas::create([
            'user_id'  => Auth::id(),
            'upload_id'=> $upload->id,
            'aksi'     => 'hapus',
            'detail'   => $upload->judul,
        ]);

        Storage::disk('public')->delete('uploads/anggota/'.$upload->file_name);
        $upload->delete();

        return back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
