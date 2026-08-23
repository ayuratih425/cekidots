@extends('layouts.admin')
@section('title', 'Kelola Anggota - CEKIDOT')

@section('styles')
<style>
    .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
    .header h1 { font-size:24px; color:#0f3b5e; display:flex; align-items:center; gap:10px; }
    .header h1 i { color:#eab308; }
    .header .info { color:#64748b; font-size:14px; }
    .header .admin-welcome { font-size:14px; color:#64748b; }
    .header .admin-welcome i { color:#eab308; margin-right:4px; }

    .alert { padding:12px 18px; border-radius:8px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-size:14px; animation:slideDown 0.3s ease; }
    @keyframes slideDown { from{opacity:0;transform:translateY(-10px)} to{opacity:1;transform:translateY(0)} }
    .alert-success { background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
    .alert-error   { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }
    .alert i { font-size:18px; }

    .section-card { background:#fff; border-radius:16px; border:1px solid #e8ecf1; box-shadow:0 4px 16px rgba(0,0,0,0.02); overflow:hidden; margin-bottom:24px; }
    .section-card-header { display:flex; justify-content:space-between; align-items:center; padding:14px 24px; background:#f8fafc; border-bottom:2px solid #e2e8f0; flex-wrap:wrap; gap:8px; }
    .section-card-header h3 { font-size:15px; font-weight:700; color:#0f3b5e; display:flex; align-items:center; gap:8px; }
    .section-card-header h3 i { color:#eab308; }
    .section-card-body { padding:24px; }

    .bidang-info { display:inline-flex; align-items:center; gap:8px; background:#fef3c7; color:#92400e; padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600; border:1px solid #fde68a; }
    .bidang-info i { color:#eab308; }

    .form-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(210px,1fr)); gap:16px; margin-bottom:18px; }
    .form-group { display:flex; flex-direction:column; gap:6px; }
    .form-group.full-width { grid-column:1/-1; }
    .form-group label { font-size:13px; font-weight:600; color:#1e293b; }
    .form-group label .required { color:#ef4444; }
    .form-group input, .form-group select {
        padding:9px 13px; border:1.5px solid #e2e8f0; border-radius:9px;
        font-size:14px; font-family:inherit; background:#fff; transition:border-color 0.2s;
    }
    .form-group input:focus, .form-group select:focus { outline:none; border-color:#0f3b5e; box-shadow:0 0 0 3px rgba(15,59,94,0.06); }

    .btn { display:inline-flex; align-items:center; gap:7px; padding:9px 22px; border-radius:9px; font-size:13px; font-weight:600; border:none; cursor:pointer; transition:all 0.25s; text-decoration:none; }
    .btn-primary { background:#0f3b5e; color:#fff; }
    .btn-primary:hover { background:#0a2a44; transform:translateY(-1px); box-shadow:0 4px 12px rgba(15,59,94,0.25); }
    .btn-secondary { background:#f1f5f9; color:#1e293b; }
    .btn-secondary:hover { background:#e2e8f0; }
    .btn-sm { padding:5px 12px; font-size:12px; }
    .btn-success { background:#d1fae5; color:#065f46; }
    .btn-success:hover { background:#a7f3d0; }
    .btn-warning { background:#fef3c7; color:#92400e; }
    .btn-warning:hover { background:#fde68a; }
    .btn-danger { background:#fef2f2; color:#dc2626; }
    .btn-danger:hover { background:#fecaca; }

    .data-table { width:100%; border-collapse:collapse; font-size:14px; }
    .data-table th { text-align:left; padding:11px 14px; background:#f8fafc; font-weight:600; color:#1e293b; border-bottom:2px solid #e2e8f0; font-size:12px; text-transform:uppercase; letter-spacing:0.5px; }
    .data-table td { padding:11px 14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
    .data-table tr:last-child td { border-bottom:none; }
    .data-table tr:hover td { background:#f8fafc; }
    .data-table .empty-state { text-align:center; padding:48px 20px; color:#94a3b8; }

    .badge-status { display:inline-block; padding:3px 12px; border-radius:12px; font-size:11px; font-weight:700; }
    .badge-status.aktif { background:#d1fae5; color:#065f46; }
    .badge-status.nonaktif { background:#fef2f2; color:#dc2626; }

    @media(max-width:768px) {
        .header { flex-direction:column; align-items:flex-start; }
        .form-grid { grid-template-columns:1fr 1fr; }
        .data-table { font-size:13px; }
    }
    @media(max-width:480px) { .form-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div class="header">
    <div>
        <h1><i class="fas fa-user-friends"></i> Kelola Anggota</h1>
        <span class="info">Manajemen anggota dalam bidang Anda</span>
    </div>
    <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
        <span class="bidang-info">
            <i class="fas fa-building"></i> {{ auth()->user()->bidang?->nama_bidang ?? 'Semua Bidang' }}
        </span>
        <div class="admin-welcome">
            <i class="fas fa-user-circle"></i> {{ auth()->user()->nama_admin ?? 'Admin' }}
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-user-plus"></i> Tambah Anggota Baru</h3>
    </div>
    <div class="section-card-body">
        <form action="{{ route('admin.anggota.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama_admin" required placeholder="Nama lengkap anggota">
                </div>
                <div class="form-group">
                    <label>Username <span class="required">*</span></label>
                    <input type="text" name="username" required placeholder="Username login">
                </div>
                <div class="form-group">
                    <label>Password <span class="required">*</span></label>
                    <input type="password" name="password" required minlength="6" placeholder="Min. 6 karakter">
                </div>
                <div class="form-group">
                    <label>Divisi</label>
                    <select name="divisi">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach(['Kepegawaian','Program','Keuangan','Ekraf','Destinasi','Pemasaran','Sdm'] as $d)
                        <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full-width">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@contoh.com">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Anggota</button>
        </form>
    </div>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-users"></i> Daftar Anggota</h3>
        <span style="font-size:13px; color:#64748b; background:#fff; padding:3px 14px; border-radius:20px; border:1px solid #e2e8f0;">
            {{ $anggota->count() }} anggota
        </span>
    </div>
    <div class="section-card-body" style="padding:0;">
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Divisi</th>
                        <th>Bidang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $a)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:50%; background:{{ $a->is_active ? '#0f3b5e' : '#94a3b8' }}; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; flex-shrink:0;">
                                    {{ strtoupper(substr($a->nama_admin, 0, 1)) }}
                                </div>
                                <div style="font-weight:600; color:#0f3b5e;">{{ $a->nama_admin }}</div>
                            </div>
                        </td>
                        <td style="font-family:monospace; font-size:13px; color:#475569;">{{ $a->username }}</td>
                        <td>{{ $a->divisi ?? '-' }}</td>
                        <td style="font-size:13px; color:#64748b;">{{ $a->bidang->nama_bidang ?? '-' }}</td>
                        <td>
                            @if($a->is_active)
                            <span class="badge-status aktif">✓ Aktif</span>
                            @else
                            <span class="badge-status nonaktif">✗ Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('admin.anggota.toggle', $a->id) }}" class="btn btn-sm {{ $a->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $a->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas {{ $a->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    {{ $a->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </a>
                                <a href="{{ route('admin.anggota.destroy', $a->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus anggota {{ $a->nama_admin }}?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-user-friends" style="font-size:36px; display:block; margin-bottom:10px; opacity:0.2;"></i>
                            Belum ada anggota
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
