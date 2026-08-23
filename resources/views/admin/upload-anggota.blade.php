@extends('layouts.admin')
@section('title', 'Upload Anggota - CEKIDOT')

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
    .alert i { font-size:18px; }

    .section-card { background:#fff; border-radius:16px; border:1px solid #e8ecf1; box-shadow:0 4px 16px rgba(0,0,0,0.02); overflow:hidden; margin-bottom:20px; }
    .section-card-header { display:flex; justify-content:space-between; align-items:center; padding:14px 24px; background:#f8fafc; border-bottom:2px solid #e2e8f0; flex-wrap:wrap; gap:8px; }
    .section-card-header h3 { font-size:15px; font-weight:700; color:#0f3b5e; display:flex; align-items:center; gap:8px; }
    .section-card-header h3 i { color:#eab308; }
    .section-card-body { padding:20px 24px; }

    .filter-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(180px,1fr)); gap:12px; align-items:end; }
    .form-group { display:flex; flex-direction:column; gap:5px; }
    .form-group label { font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.4px; }
    .form-group input, .form-group select {
        padding:9px 13px; border:1.5px solid #e2e8f0; border-radius:9px;
        font-size:13px; font-family:inherit; background:#fff; transition:border-color 0.2s;
    }
    .form-group input:focus, .form-group select:focus { outline:none; border-color:#0f3b5e; box-shadow:0 0 0 3px rgba(15,59,94,0.06); }

    .btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:9px; font-size:13px; font-weight:600; border:none; cursor:pointer; transition:all 0.25s; text-decoration:none; }
    .btn-primary { background:#0f3b5e; color:#fff; }
    .btn-primary:hover { background:#0a2a44; transform:translateY(-1px); }
    .btn-secondary { background:#f1f5f9; color:#475569; }
    .btn-secondary:hover { background:#e2e8f0; }
    .btn-sm { padding:5px 12px; font-size:12px; }
    .btn-info { background:#dbeafe; color:#1d4ed8; }
    .btn-info:hover { background:#93c5fd; }
    .btn-danger { background:#fef2f2; color:#dc2626; }
    .btn-danger:hover { background:#fecaca; }

    .data-table { width:100%; border-collapse:collapse; font-size:14px; min-width:700px; }
    .data-table th { text-align:left; padding:11px 14px; background:#f8fafc; font-weight:600; color:#1e293b; border-bottom:2px solid #e2e8f0; font-size:12px; text-transform:uppercase; letter-spacing:0.5px; }
    .data-table td { padding:11px 14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
    .data-table tr:last-child td { border-bottom:none; }
    .data-table tr:hover td { background:#f8fafc; }
    .data-table .empty-state { text-align:center; padding:48px 20px; color:#94a3b8; }

    .badge-divisi { display:inline-block; padding:2px 10px; border-radius:12px; font-size:11px; font-weight:600; background:#f1f5f9; color:#475569; }

    @media(max-width:768px) {
        .header { flex-direction:column; align-items:flex-start; }
        .filter-grid { grid-template-columns:1fr 1fr; }
    }
    @media(max-width:480px) { .filter-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div class="header">
    <div>
        <h1><i class="fas fa-file-upload"></i> Dokumen Upload Anggota</h1>
        <span class="info">Pantau semua dokumen yang diupload oleh anggota</span>
    </div>
    <div class="admin-welcome">
        <i class="fas fa-user-circle"></i> {{ auth()->user()->nama_admin ?? 'Admin' }}
    </div>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-filter"></i> Filter Dokumen</h3>
    </div>
    <div class="section-card-body">
        <form method="GET" action="{{ route('admin.upload.index') }}">
            <div class="filter-grid">
                <div class="form-group">
                    <label>Cari</label>
                    <input type="text" name="search" placeholder="Judul / nama anggota..." value="{{ request('search') }}">
                </div>
                <div class="form-group">
                    <label>Folder</label>
                    <select name="folder_id">
                        <option value="">-- Semua Folder --</option>
                        @foreach($folders as $f)
                        <option value="{{ $f->id }}" {{ request('folder_id') == $f->id ? 'selected' : '' }}>{{ $f->nama }}</option>
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->isSuperAdmin())
                <div class="form-group">
                    <label>Divisi</label>
                    <select name="divisi">
                        <option value="">-- Semua Divisi --</option>
                        @foreach($divisi_list as $d)
                        <option value="{{ $d }}" {{ request('divisi') == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan">
                        <option value="">-- Semua Bulan --</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                        <option value="{{ $i+1 }}" {{ request('bulan') == $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun">
                        <option value="">-- Semua Tahun --</option>
                        @foreach(range(date('Y'), 2025) as $y)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div style="display:flex; gap:8px;">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.upload.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-list"></i> Daftar Dokumen</h3>
        <span style="font-size:13px; color:#64748b; background:#fff; padding:3px 14px; border-radius:20px; border:1px solid #e2e8f0;">
            {{ $uploads->total() }} dokumen
        </span>
    </div>
    <div class="section-card-body" style="padding:0;">
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Anggota</th>
                        <th>Divisi</th>
                        <th>Folder</th>
                        <th>Judul Dokumen</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($uploads as $up)
                    <tr>
                        <td style="font-size:13px; color:#64748b; white-space:nowrap;">
                            <i class="fas fa-calendar" style="color:#eab308; margin-right:4px;"></i>
                            {{ \Carbon\Carbon::parse($up->tanggal_upload)->format('d/m/Y') }}
                        </td>
                        <td>
                            <div style="font-weight:600; color:#0f3b5e;">{{ $up->user->nama_admin ?? '-' }}</div>
                        </td>
                        <td><span class="badge-divisi">{{ $up->user->divisi ?? '-' }}</span></td>
                        <td>
                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:13px;">
                                <i class="fas fa-folder" style="color:#eab308;"></i>
                                {{ $up->folder->nama ?? '-' }}
                            </span>
                        </td>
                        <td style="font-weight:500;">{{ $up->judul }}</td>
                        <td>
                            <a href="{{ Storage::url('uploads/anggota/' . $up->file_name) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.upload.destroy', $up->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dokumen ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class="fas fa-file-upload" style="font-size:36px; display:block; margin-bottom:10px; opacity:0.2;"></i>
                            Belum ada dokumen yang diupload
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($uploads->hasPages())
        <div style="padding:16px 24px; border-top:1px solid #f1f5f9;">
            {{ $uploads->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
