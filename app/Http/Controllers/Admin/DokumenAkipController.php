<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenAkip;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenAkipController extends Controller
{
    private array $tahun_list;

    public function __construct()
    {
        $this->tahun_list = range(2025, 2030);
    }

    private function tahunAktif(): int
    {
        $tahun = (int) request('tahun', date('Y'));
        return in_array($tahun, $this->tahun_list) ? $tahun : $this->tahun_list[0];
    }

    private function uploadFile($file, string $folder): array
    {
        $name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $type = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $dest = public_path('storage/uploads/'.$folder);
        if (!file_exists($dest)) mkdir($dest, 0755, true);
        $file->move($dest, $name);
        return ['name' => $name, 'type' => $type, 'size' => $size];
    }

    private function deleteFile(?string $name, string $folder): void
    {
        if ($name) {
            $path = public_path('storage/uploads/'.$folder.'/'.$name);
            if (file_exists($path)) unlink($path);
        }
    }

    public function index()
    {
        $tahun_aktif = $this->tahunAktif();
        return view('admin.akip', [
            'dokumen'     => DokumenAkip::where('tahun', $tahun_aktif)->orderBy('urutan')->get(),
            'tahun_aktif' => $tahun_aktif,
            'tahun_list'  => $this->tahun_list,
            'total_baru'  => SuratMasuk::where('status', 'baru')->count(),
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

        $fileData = ['name' => '', 'type' => '', 'size' => 0];
        if ($request->hasFile('file_dokumen')) {
            $fileData = $this->uploadFile($request->file('file_dokumen'), 'akip');
        }

        DokumenAkip::create([
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'file_dokumen' => $fileData['name'],
            'tipe_konten'  => $request->tipe_konten,
            'link_url'     => $request->tipe_konten === 'link' ? $request->link_url : null,
            'file_type'    => $fileData['type'],
            'file_size'    => $fileData['size'],
            'tahun'        => $request->tahun,
            'urutan'       => (DokumenAkip::where('tahun', $request->tahun)->max('urutan') ?? 0) + 1,
            'status'       => 'aktif',
        ]);

        return redirect()->route('admin.akip.index', ['tahun' => $request->tahun])
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $dokumen = DokumenAkip::findOrFail($request->edit_id);

        $request->validate([
            'edit_judul'       => 'required|string',
            'edit_tahun'       => 'required|integer',
            'edit_tipe_konten' => 'required|in:file,link',
            'edit_link_url'    => 'required_if:edit_tipe_konten,link|nullable|url',
            'edit_file'        => 'nullable|file|max:10240',
        ]);

        $data = [
            'judul'       => $request->edit_judul,
            'deskripsi'   => $request->edit_deskripsi,
            'tahun'       => $request->edit_tahun,
            'tipe_konten' => $request->edit_tipe_konten,
        ];

        if ($request->edit_tipe_konten === 'link') {
            $this->deleteFile($dokumen->file_dokumen, 'akip');
            $data += ['link_url' => $request->edit_link_url, 'file_dokumen' => null, 'file_type' => '', 'file_size' => 0];
        } else {
            $data['link_url'] = null;
            if ($request->hasFile('edit_file')) {
                $this->deleteFile($dokumen->file_dokumen, 'akip');
                $f = $this->uploadFile($request->file('edit_file'), 'akip');
                $data += ['file_dokumen' => $f['name'], 'file_type' => $f['type'], 'file_size' => $f['size']];
            }
        }

        $dokumen->update($data);

        return redirect()->route('admin.akip.index', ['tahun' => $request->edit_tahun])
            ->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dokumen = DokumenAkip::findOrFail($id);
        $this->deleteFile($dokumen->file_dokumen, 'akip');
        $dokumen->delete();
        return redirect()->route('admin.akip.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $dokumen = DokumenAkip::findOrFail($id);
        $dokumen->update(['status' => $dokumen->status === 'aktif' ? 'nonaktif' : 'aktif']);
        return redirect()->route('admin.akip.index')->with('success', 'Status dokumen berhasil diubah!');
    }
}