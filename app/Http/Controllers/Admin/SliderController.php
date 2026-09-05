<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $slides = Slider::orderBy('urutan')->get();
        return view('admin.slider', ['slides' => $slides, 'total_slider' => $slides->count()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:15360',
        ]);

        $file = $request->file('gambar');
        $name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());

        // Pakai Storage facade — lebih aman dan konsisten
        $file->storeAs('uploads/slider', $name, 'public');

        Slider::create([
            'gambar' => $name,
            'judul'  => $request->judul,
            'urutan' => (Slider::max('urutan') ?? 0) + 1,
            'status' => 'aktif',
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.slider.index')->with('success', 'Slide berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Storage::disk('public')->delete('uploads/slider/'.$slider->gambar);
        $slider->delete();

        Cache::forget('home_page_data');

        return redirect()->route('admin.slider.index')->with('success', 'Slide berhasil dihapus!');
    }
}