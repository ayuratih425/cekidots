<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenIki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenIkiController extends Controller
{
    private array $tahun_list;
    private array $divisi_list;

    public function __construct()
    {
        $this->tahun_list  = range(2025, 2030);
        $this->divisi_list = ['Kepegawaian', 'Program', 'Keuangan', 'Ekraf', 'Destinasi', 'Pemasaran', 'Sdm'];
    }

    private function tahunAktif(): int
    {
        $tahun = (int) request('tahun', date('Y'));
        return in_array($tahun, $this->tahun_list) ? $tahun : $this->tahun_list[0];
    }

    private function uploadFile($file, string $folder): array
    {
        $name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $dest = public_path('storage/uploads/'.$folder);
        if (!file_exists($dest)) mkdir($dest, 0755, true);
        $file->move($dest, $name);
        return ['name' => $name, 'type' => $file->getClientOriginalExtension(), 'size' => $file->getSize()];
    }

    private function deleteFile(?string $name, string $folder): void
    {
        if ($name) {
            $path = public_path('storage/uploads/'.$folder.'/'.$name);
            if (file_exists($path)) unlink($path);
        }
    }

    private function authorizeOwner(DokumenIki $dokumen): void
    {
        $user = Auth::user();
        if ($user->isAdminDivisi() && $dokumen->divisi !== $user->divisi) {
            abort(403, 'Anda hanya dapat mengelola dokumen divisi Anda.');
        }
    }

    public function index()
    {
        $user         = Auth::user();
        $tahun_aktif  = $this->tahunAktif();
        $kategori_aktif = request('kategori', '');

        $dokumen = DokumenIki::where('tahun', $tahun_aktif)
            ->when($user->isAdminDivisi(), fn ($q) => $q->where('divisi', $user->divisi))
            ->when($kategori_aktif !== '', fn ($q) => $q->where('kategori', $kategori_aktif))
            ->orderBy('urutan')->get();

        $kategori_list = DokumenIki::whereNotNull('kategori')->where('kategori', '!=', '')
            ->orderBy('kategori')->distinct()->pluck('kategori');

        return view('admin.iki', [
            'dokumen'        => $dokumen,
            'tahun_aktif'    => $tahun_aktif,
            'tahun_list'     => $this->tahun_list,
            'total_baru'     => 0,
            'divisi_list'    => $this->divisi_list,
            'is_admin_divisi'=> $user->isAdminDivisi(),
            'kategori_list'  => $kategori_list,
            'kategori_aktif' => $kategori_aktif,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string',
            'tahun'        => 'required|integer',
            'tipe_konten'  => 'required|in:file,link',
            'file_dokumen' => 'required_if:tipe_konten,file|file|max:10240',
            'link_url'     => 'required_if:tipe_konten,link|nullable|url',
        ]);

        $user    = Auth::user();
        $fileData = ['name' => '', 'type' => '', 'size' => 0];
        if ($request->hasFile('file_dokumen')) {
            $fileData = $this->uploadFile($request->file('file_dokumen'), 'iki');
        }

        DokumenIki::create([
            'judul'        => $request->judul,
            'kategori'     => $request->kategori,
            'deskripsi'    => $request->deskripsi,
            'file_dokumen' => $fileData['name'],
            'tipe_konten'  => $request->tipe_konten,
            'link_url'     => $request->tipe_konten === 'link' ? $request->link_url : null,
            'file_type'    => $fileData['type'],
            'file_size'    => $fileData['size'],
            'tahun'        => $request->tahun,
            'divisi'       => $user->isAdminDivisi() ? $user->divisi : $request->divisi,
            'urutan'       => (DokumenIki::where('tahun', $request->tahun)->max('urutan') ?? 0) + 1,
            'status'       => 'aktif',
        ]);

        return redirect()->route('admin.iki.index', ['tahun' => $request->tahun])
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $dokumen = DokumenIki::findOrFail($request->edit_id);
        $this->authorizeOwner($dokumen);

        $request->validate([
            'edit_judul'       => 'required|string',
            'edit_tahun'       => 'required|integer',
            'edit_tipe_konten' => 'required|in:file,link',
            'edit_link_url'    => 'required_if:edit_tipe_konten,link|nullable|url',
            'edit_file'        => 'nullable|file|max:10240',
        ]);

        $user = Auth::user();
        $data = [
            'judul'       => $request->edit_judul,
            'kategori'    => $request->edit_kategori,
            'deskripsi'   => $request->edit_deskripsi,
            'tahun'       => $request->edit_tahun,
            'tipe_konten' => $request->edit_tipe_konten,
        ];
        if ($user->isAdminDivisi()) $data['divisi'] = $user->divisi;

        if ($request->edit_tipe_konten === 'link') {
            $this->deleteFile($dokumen->file_dokumen, 'iki');
            $data += ['link_url' => $request->edit_link_url, 'file_dokumen' => null, 'file_type' => '', 'file_size' => 0];
        } else {
            $data['link_url'] = null;
            if ($request->hasFile('edit_file')) {
                $this->deleteFile($dokumen->file_dokumen, 'iki');
                $f = $this->uploadFile($request->file('edit_file'), 'iki');
                $data += ['file_dokumen' => $f['name'], 'file_type' => $f['type'], 'file_size' => $f['size']];
            }
        }

        $dokumen->update($data);
        return redirect()->route('admin.iki.index', ['tahun' => $request->edit_tahun])
            ->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dokumen = DokumenIki::findOrFail($id);
        $this->authorizeOwner($dokumen);
        $this->deleteFile($dokumen->file_dokumen, 'iki');
        $dokumen->delete();
        return redirect()->route('admin.iki.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $dokumen = DokumenIki::findOrFail($id);
        $this->authorizeOwner($dokumen);
        $dokumen->update(['status' => $dokumen->status === 'aktif' ? 'nonaktif' : 'aktif']);
        return redirect()->route('admin.iki.index')->with('success', 'Status dokumen berhasil diubah!');
    }
}
