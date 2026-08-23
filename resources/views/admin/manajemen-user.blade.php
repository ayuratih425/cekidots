@extends('layouts.admin')
@section('title', 'Manajemen User - CEKIDOT')

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

    .form-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(210px,1fr)); gap:16px; margin-bottom:18px; }
    .form-group { display:flex; flex-direction:column; gap:6px; }
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

    .badge-role { display:inline-block; padding:3px 12px; border-radius:12px; font-size:11px; font-weight:700; text-transform:capitalize; }
    .badge-role.super_admin { background:#fef3c7; color:#92400e; }
    .badge-role.admin_divisi { background:#dbeafe; color:#1d4ed8; }
    .badge-role.anggota { background:#f1f5f9; color:#475569; }

    /* Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); backdrop-filter:blur(5px); z-index:9999; align-items:center; justify-content:center; padding:20px; }
    .modal-overlay.show { display:flex; }
    .modal-box { background:#fff; border-radius:18px; max-width:520px; width:100%; padding:28px 28px 24px; box-shadow:0 30px 80px rgba(0,0,0,0.25); animation:modalIn 0.3s ease; max-height:90vh; overflow-y:auto; }
    @keyframes modalIn { from{opacity:0;transform:scale(0.95) translateY(16px)} to{opacity:1;transform:scale(1) translateY(0)} }
    .modal-box h3 { font-size:18px; font-weight:700; color:#0f3b5e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
    .modal-box h3 i { color:#eab308; }
    .modal-box .form-group { margin-bottom:14px; }
    .modal-actions { display:flex; gap:10px; margin-top:20px; }

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
        <h1><i class="fas fa-users-cog"></i> Manajemen User</h1>
        <span class="info">Kelola akun pengguna sistem CEKIDOT</span>
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
        <h3><i class="fas fa-user-plus"></i> Tambah Akun Baru</h3>
    </div>
    <div class="section-card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama_admin" required placeholder="Nama lengkap">
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
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label>Divisi <span class="required">*</span></label>
                    <select name="divisi" required>
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisi_list as $d)
                        <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->isSuperAdmin())
                <div class="form-group">
                    <label>Role</label>
                    <select name="role">
                        <option value="anggota">Anggota</option>
                        <option value="admin_divisi">Admin Divisi</option>
                    </select>
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Akun</button>
        </form>
    </div>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h3><i class="fas fa-users"></i> Daftar User</h3>
        <span style="font-size:13px; color:#64748b; background:#fff; padding:3px 14px; border-radius:20px; border:1px solid #e2e8f0;">
            {{ $users->count() }} akun
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
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:50%; background:#0f3b5e; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; flex-shrink:0;">
                                    {{ strtoupper(substr($u->nama_admin, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600; color:#0f3b5e;">{{ $u->nama_admin }}</div>
                                    @if($u->email)
                                    <div style="font-size:12px; color:#94a3b8;">{{ $u->email }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="font-family:monospace; font-size:13px; color:#475569;">{{ $u->username }}</td>
                        <td>{{ $u->divisi ?? '-' }}</td>
                        <td><span class="badge-role {{ $u->role }}">{{ str_replace('_', ' ', $u->role) }}</span></td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <button class="btn btn-sm btn-warning" onclick="editUser({{ $u->id }}, '{{ addslashes($u->nama_admin) }}', '{{ $u->username }}', '{{ $u->email }}', '{{ $u->divisi }}', '{{ $u->role }}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="{{ route('admin.users.destroy', $u->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user {{ $u->nama_admin }}?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty-state">Belum ada user</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h3><i class="fas fa-user-edit"></i> Edit User</h3>
        <form id="formEdit" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_admin" id="edit_nama" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="edit_username" required>
            </div>
            <div class="form-group">
                <label>Password Baru <span style="font-size:11px; color:#94a3b8; font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" minlength="6" placeholder="Password baru...">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit_email">
            </div>
            <div class="form-group">
                <label>Divisi</label>
                <select name="divisi" id="edit_divisi">
                    @foreach($divisi_list as $d)
                    <option value="{{ $d }}">{{ $d }}</option>
                    @endforeach
                </select>
            </div>
            @if(auth()->user()->isSuperAdmin())
            <div class="form-group">
                <label>Role</label>
                <select name="role" id="edit_role">
                    <option value="anggota">Anggota</option>
                    <option value="admin_divisi">Admin Divisi</option>
                </select>
            </div>
            @endif
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
function editUser(id, nama, username, email, divisi, role) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_divisi').value = divisi;
    var roleEl = document.getElementById('edit_role');
    if (roleEl) roleEl.value = role || 'anggota';
    document.getElementById('formEdit').action = '/admin/users/' + id;
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
