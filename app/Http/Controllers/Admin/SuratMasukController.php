<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $surat      = SuratMasuk::orderByDesc('id')->paginate(20)->withQueryString();
        $total_baru = SuratMasuk::where('status', 'baru')->count();
        return view('admin.surat-masuk', compact('surat', 'total_baru'));
    }

    public function destroy(Request $request)
    {
        $surat = SuratMasuk::findOrFail($request->delete_id);

        if ($surat->file_surat) {
            Storage::disk('public')->delete('uploads/surat/'.$surat->file_surat);
        }

        $surat->delete();
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus!');
    }

    public function tandaiDibaca($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->update([
            'dibaca' => true,
            'status' => 'dibaca',
        ]);
        return redirect()->route('admin.surat.index')->with('success', 'Surat ditandai sudah dibaca!');
    }
}