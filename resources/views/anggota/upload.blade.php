@extends('layouts.anggota')
@section('title', 'Upload Dokumen - Portal Anggota CEKIDOT')

@section('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: #0f172a; }
    .page-header p { font-size: 14px; color: #64748b; margin-top: 4px; }

    .content-grid { display: grid; grid-template-columns: 380px 1fr; gap: 24px; align-items: start; }

    .panel { background: #fff; border-radius: 16px; border: 1px solid #e8ecf1; overflow: hidden; }
    .panel-header { padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px; }
    .panel-header h3 { font-size: 15px; font-weight: 700; color: #0f172a; }
    .panel-header i { color: #eab308; font-size: 16px; }
    .panel-body { padding: 24px; }

    .alert { padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; }
    .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    .form-group { margin-bottom: 16px; }
    .form-group label { font-weight: 600; font-size: 13px; display: block; margin-bottom: 5px; color: #1e293b; }
    .form-group label .req { color: #ef4444; }
    .form-control {
        width: 100%; padding: 9px 13px; border: 1.5px solid #e2e8f0;
        border-radius: 8px; font-size: 13px; font-family: inherit;
        background: #fff; transition: border-color 0.2s; box-sizing: border-box;
    }
    .form-control:focus { outline: none; border-color: #0f3b5e; }
    textarea.form-control { min-height: 70px; resize: vertical; }
    .form-hint { font-size: 11px; color: #94a3b8; margin-top: 4px; }

    .btn-primary {
        width: 100%; padding: 11px; background: #0f3b5e; color: #fff;
        border: none; border-radius: 8px; font-weight: 600; font-size: 14px;
        cursor: pointer; transition: all 0.2s; display: flex; align-items: center;
        justify-content: center; gap: 8px;
    }
    .btn-primary:hover { background: #0a2a44; }

    .upload-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .upload-table th { text-align: left; padding: 10px 16px; background: #f8fafc; font-weight: 600; color: #1e293b; border-bottom: 2px solid #e2e8f0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
    .upload-table td { padding: 10px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .upload-table tr:last-child td { border-bottom: none; }
    .upload-table tr:hover td { background: #f8fafc; }

    .badge-folder { background: #f1f5f9; padding: 2px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; color: #475569; }
    .badge-ext { background: #ede9fe; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; color: #6d28d9; text-transform: uppercase; }

    .btn-sm { padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s; }
    .btn-info { background: #dbeafe; color: #1d4ed8; }
    .btn-info:hover { background: #93c5fd; }
    .btn-danger { background: #fef2f2; color: #991b1b; }
    .btn-danger:hover { background: #fecaca; }

    .empty-state { text-align: center; padding: 48px 20px; color: #94a3b8; }
    .empty-state i { font-size: 40px; opacity: 0.2; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 14px; }

    .filter-bar { display: flex; gap: 10px; padding: 16px 24px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; }
    .filter-bar input, .filter-bar select {
        padding: 7px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 13px; font-family: inherit; background: #fff;
    }
    .filter-bar input:focus, .filter-bar select:focus { outline: none; border-color: #0f3b5e; }
    .filter-bar input { flex: 1; min-width: 160px; }

    @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')

<div class="page-header">
    <h1><i class="fas fa-cloud-upload-alt" style="color:#eab308;"></i> Upload Dokumen</h1>
    <p>Upload dan kelola dokumen Anda di sini</p>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif
@if($errors->any())
<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
@endif

<div class="content-grid">

    {{-- Form Upload --}}
    <div class="panel">
        <div class="panel-header">
            <i class="fas fa-plus-circle"></i>
            <h3>Upload Dokumen Baru</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Folder <span class="req">*</span></label>
                    <select name="folder_id" required class="form-control">
                        <option value="">-- Pilih Folder --</option>
                        @foreach($folders as $folder)
                        <option value="{{ $folder->id }}" {{ old('folder_id') == $folder->id ? 'selected' : '' }}>
                            {{ $folder->nama }}
                            @if($folder->divisi !== 'Semua') ({{ $folder->divisi }}) @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Judul Dokumen <span class="req">*</span></label>
                    <input type="text" name="judul" class="form-control" required
                        placeholder="Judul dokumen" value="{{ old('judul') }}">
                </div>
                <div class="form-group">
                    <label>Tanggal <span class="req">*</span></label>
                    <input type="date" name="tanggal_upload" class="form-control" required
                        value="{{ old('tanggal_upload', date('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label>File <span class="req">*</span></label>
                    <input type="file" name="file_dokumen" class="form-control" required>
                    <p class="form-hint"><i class="fas fa-info-circle"></i> Maks 50MB. PDF, Word, Excel, dll.</p>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2"
                        placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                </div>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-upload"></i> Upload Dokumen
                </button>
            </form>
        </div>
    </div>

    {{-- Riwayat Upload --}}
    <div class="panel">
        <div class="panel-header">
            <i class="fas fa-history"></i>
            <h3>Riwayat Upload Saya ({{ $uploads->count() }})</h3>
        </div>

        <form method="GET" action="{{ route('anggota.upload') }}">
            <div class="filter-bar">
                <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}">
                <select name="folder">
                    <option value="">Semua Folder</option>
                    @foreach($folders as $folder)
                    <option value="{{ $folder->id }}" {{ request('folder') == $folder->id ? 'selected' : '' }}>
                        {{ $folder->nama }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-sm btn-info"><i class="fas fa-search"></i></button>
            </div>
        </form>

        @php
            $filtered = $uploads;
            if(request('search')) $filtered = $filtered->filter(fn($u) => str_contains(strtolower($u->judul), strtolower(request('search'))));
            if(request('folder')) $filtered = $filtered->filter(fn($u) => $u->folder_id == request('folder'));
        @endphp

        @if($filtered->isEmpty())
        <div class="empty-state">
            <i class="fas fa-file-alt"></i>
            <p>Belum ada dokumen yang diupload.</p>
        </div>
        @else
        <div style="overflow-x:auto;">
            <table class="upload-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Folder</th>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filtered as $i => $up)
                    <tr>
                        <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                        <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($up->tanggal_upload)->format('d/m/Y') }}</td>
                        <td><span class="badge-folder">{{ $up->folder->nama ?? '-' }}</span></td>
                        <td style="max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $up->judul }}">
                            {{ $up->judul }}
                            @if($up->keterangan)
                            <br><small style="color:#94a3b8;">{{ Str::limit($up->keterangan, 40) }}</small>
                            @endif
                        </td>
                        <td><span class="badge-ext">{{ $up->file_type ?: '-' }}</span></td>
                        <td>
                            <div style="display:flex; gap:4px;">
                                <a href="{{ Storage::url('uploads/anggota/' . $up->file_name) }}" target="_blank" class="btn-sm btn-info">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('anggota.delete', $up->id) }}" class="btn-sm btn-danger"
                                    onclick="return confirm('Hapus dokumen \'{{ addslashes($up->judul) }}\'?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection
