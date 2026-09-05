<?php

namespace App\Http\Controllers\Admin\Anggota;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaAnggotaController extends Controller
{
    private function authorizeAnggota(User $target): void
    {
        $auth = Auth::user();
        if ($auth->isAdminDivisi() && ($target->divisi !== $auth->divisi || $target->role !== 'anggota')) {
            abort(403, 'Anda hanya dapat mengelola anggota divisi Anda.');
        }
    }

    public function index()
    {
        $user    = Auth::user();
        $anggota = User::where('role', 'anggota')
            ->when($user->isAdminDivisi(), fn ($q) => $q->where('divisi', $user->divisi))
            ->orderBy('nama_admin')->get();

        return view('admin.kelola-anggota', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|unique:users,username',
            'nama_admin' => 'required|string',
            'password'   => 'required|string|min:6',
            'divisi'     => 'required|string',
        ]);

        User::create([
            'username'   => $request->username,
            'nama_admin' => $request->nama_admin,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'anggota',
            'divisi'     => $request->divisi,
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAnggota($user);

        $request->validate([
            'nama_admin' => 'required|string',
            'username'   => 'required|string|unique:users,username,'.$user->id,
        ]);

        $data = [
            'nama_admin' => $request->nama_admin,
            'username'   => $request->username,
            'email'      => $request->email,
            'divisi'     => $request->divisi,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return back()->with('success', 'Anggota berhasil diupdate!');
    }

    public function toggleActive(User $user)
    {
        $this->authorizeAnggota($user);
        $user->update(['is_active' => ! $user->is_active]);
        return back()->with('success', 'Status anggota berhasil diubah!');
    }

    public function destroy(User $user)
    {
        $this->authorizeAnggota($user);
        $user->delete();
        return back()->with('success', 'Anggota berhasil dihapus!');
    }
}
