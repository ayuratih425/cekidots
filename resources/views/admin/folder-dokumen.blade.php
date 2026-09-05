@extends('layouts.admin')
@section('title', 'Folder Dokumen - CEKIDOT')

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

    .section-card {
        background:#fff;
        border-radius:16px;
        border:1px solid #e8ecf1;
        box-shadow:0 4px 16px rgba(0,0,0,0.02);
        overflow:hidden;
        margin-bottom:24px;
    }
    .section-card-header {
        display:flex; justify-content:space-between; align-items:center;
        padding:14px 24px;
        background:#f8fafc;
        border-bottom:2px solid #e2e8f0;
        flex-wrap:wrap; gap:8px;
    }
    .section-card-header h3 { font-size:15px; font-weight:700; color:#0f3b5e; display:flex; align-items:center; gap:8px; }
    .section-card-header h3 i { color:#eab308; }
    .section-card-body { padding:24px; }

    .form-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px,1fr)); gap:16px; margin-bottom:18px; }
    .form-group { display:flex; flex-direction:column; gap:6px; }
    .form-group.full-width { grid-column:1/-1; }
    .form-group label { font-size:13px; font-weight:600; color:#1e293b; }
    .form-group label .required { color:#ef4444; }
    .form-group input, .form-group select, .form-group textarea {
        padding:9px 13px;
        border:1.5px solid #e2e8f0;
        border-radius:9px;
        font-size:14px;
        font-family:inherit;
        background:#fff;
        transition:border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline:none; border-color:#0f3b5e; box-shadow:0 0 0 4px rgba(15,59,94,0.06);
    }

    .btn { display:inline-flex; align-items:center; gap:7px; padding:9px 22px; border-radius:9px; font-size:13px; font-weight:600; border:none; cursor:pointer; transition:all 0.25s; text-decoration:none; }
    .btn-primary { background:#0f3b5e; color:#fff; }
    .btn-primary:hover { background:#0a2a44; transform:translateY(-1px); box-shadow:0 4px 12px rgba(15,59,94,0.25); }
    .btn-secondary { background:#f1f5f9; color:#1e293b; }
    .btn-secondary:hover { background:#e2e8f0; }
    .btn-sm { padding:5px 12px; font-size:12px; }
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

    .folder-icon { color:#eab308; margin-right:6px; }

    /* Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); backdrop-filter:blur(5px); z-index:9999; align-items:center; justify-content:center; padding:20px; }
    .modal-overlay.show { display:flex; }
    .modal-box { background:#fff; border-radius:18px; max-width:480px; width:100%; padding:28px 28px 24px; box-shadow:0 30px 80px rgba(0,0,0,0.25); animation:modalIn 0.3s ease; }
    @keyframes modalIn { from{opacity:0;transform:scale(0.95) translateY(16px)} to{opacity:1;transform:scale(1) translateY(0)} }
    .modal-box h3 { font-size:18px; font-weight:700; color:#0f3b5e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
    .modal-box h3 i { color:#eab308; }
    .modal-box .form-group { margin-bottom:14px; }
    .modal-actions { display:flex; gap:10px; margin-top:20px; }

    @media(max-width:768px) {
        .header { flex-direction:column; align-items:flex-start; }
        .form-grid { grid-template-columns:1fr; }
        .data-table { font-size:13px; }
        .data-table th, .data-table td { padding:9px 10px; }
    }
</style>
@endsection

@section('content')
<div class="header">
    <div>
        <h1><i class="fas fa-folder-open"></i> Folder Dokumen</h1>
        <span class="info">Kelola folder untuk upload dokumen anggota</span>
    </div>
    <div class="admin-welcome">
        <i class="fas fa-user-circle"></i> {{ auth()->user()->nama_admin ?? 'Admin' }}
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
        <h3><i class="fas fa-folder-plus"></i> Tambah Folder Baru</h3>
    </div>
    <div class="section-card-body">
        <form action="{{ route('admin.folder.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Folder <span class="required">*</span></label>
                    <input type="text" name="nama" required placeholder="Contoh: Laporan Bulanan IKI">
                </div>
                <div class="form-group">
                    <label>Untuk Divisi</label>
                    <select name="divisi">
                        @foreach($divisi_list as $d)
                        <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi" placeholder="Deskripsi folder (opsional)">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Folder</button>
        </form>
    </div>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-folder"></i> Daftar Folder</h3>
        <span style="font-size:13px; color:#64748b; background:#fff; padding:3px 14px; border-radius:20px; border:1px solid #e2e8f0;">
            Total: {{ $folders->count() }} folder
        </span>
    </div>
    <div class="section-card-body" style="padding:0;">
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Folder</th>
                        <th>Divisi</th>
                        <th>Deskripsi</th>
                        <th>Dokumen</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($folders as $folder)
                    <tr>
                        <td>
                            <span style="font-weight:600; color:#0f3b5e;">
                                <i class="fas fa-folder folder-icon"></i>{{ $folder->nama }}
                            </span>
                        </td>
                        <td>{{ $folder->divisi ?? '-' }}</td>
                        <td style="color:#64748b; font-size:13px;">{{ $folder->deskripsi ?? '-' }}</td>
                        <td>
                            <span style="background:#dbeafe; color:#1d4ed8; padding:2px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                                {{ $folder->uploads_count }} file
                            </span>
                        </td>
                        <td style="font-size:13px; color:#64748b;">{{ $folder->pembuat->nama_admin ?? '-' }}</td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <button class="btn btn-sm btn-warning" onclick="editFolder({{ $folder->id }}, '{{ addslashes($folder->nama) }}', '{{ addslashes($folder->deskripsi) }}', '{{ $folder->divisi }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('admin.folder.destroy', $folder->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus folder ini beserta semua dokumennya?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty-state"><i class="fas fa-folder-open" style="font-size:36px; display:block; margin-bottom:10px; opacity:0.2;"></i> Belum ada folder</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h3><i class="fas fa-edit"></i> Edit Folder</h3>
        <form id="formEdit" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Folder</label>
                <input type="text" name="nama" id="edit_nama" required>
            </div>
            <div class="form-group">
                <label>Untuk Divisi</label>
                <select name="divisi" id="edit_divisi">
                    @foreach($divisi_list as $d)
                    <option value="{{ $d }}">{{ $d }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" id="edit_deskripsi">
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function editFolder(id, nama, deskripsi, divisi) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_divisi').value = divisi;
    document.getElementById('formEdit').action = '/admin/folder-dokumen/' + id;
    document.getElementById('modalEdit').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('modalEdit').classList.remove('show');
    document.body.style.overflow = 'auto';
}
document.getElementById('modalEdit').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
</script>
@endsection
