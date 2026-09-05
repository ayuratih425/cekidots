@extends('layouts.anggota')
@section('title', 'Profil Saya - Portal Anggota CEKIDOT')

@section('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: #0f172a; }
    .page-header p { font-size: 14px; color: #64748b; margin-top: 4px; }

    .content-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start; }

    .panel { background: #fff; border-radius: 16px; border: 1px solid #e8ecf1; overflow: hidden; }
    .panel-header { padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px; }
    .panel-header h3 { font-size: 15px; font-weight: 700; color: #0f172a; }
    .panel-header i { color: #eab308; font-size: 16px; }
    .panel-body { padding: 24px; }

    .profile-avatar {
        width: 72px; height: 72px;
        background: linear-gradient(135deg, #0f3b5e, #1a5a7a);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 28px; font-weight: 800; color: #eab308;
        margin: 0 auto 20px;
    }
    .profile-info-row { display: flex; flex-direction: column; gap: 14px; }
    .info-item { display: flex; flex-direction: column; gap: 3px; }
    .info-item .info-label { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-item .info-value { font-size: 14px; font-weight: 600; color: #0f172a; }
    .info-item .info-value .badge-role {
        display: inline-block; background: #dbeafe; color: #1d4ed8;
        padding: 2px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
    }
    .info-item .info-value .badge-divisi {
        display: inline-block; background: #fef3c7; color: #b45309;
        padding: 2px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
    }
    .info-divider { height: 1px; background: #f1f5f9; margin: 4px 0; }

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
    .field-error { font-size: 12px; color: #ef4444; margin-top: 4px; }

    .btn-primary {
        width: 100%; padding: 11px; background: #0f3b5e; color: #fff;
        border: none; border-radius: 8px; font-weight: 600; font-size: 14px;
        cursor: pointer; transition: all 0.2s; display: flex; align-items: center;
        justify-content: center; gap: 8px;
    }
    .btn-primary:hover { background: #0a2a44; }

    .password-hint { font-size: 12px; color: #94a3b8; margin-top: 6px; }
    .password-hint li { margin-bottom: 2px; }

    @media (max-width: 768px) { .content-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')

<div class="page-header">
    <h1><i class="fas fa-user-circle" style="color:#eab308;"></i> Profil Saya</h1>
    <p>Informasi akun dan pengaturan keamanan</p>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="content-grid">

    {{-- Info Akun --}}
    <div class="panel">
        <div class="panel-header">
            <i class="fas fa-id-card"></i>
            <h3>Informasi Akun</h3>
        </div>
        <div class="panel-body">
            <div class="profile-avatar">{{ strtoupper(substr($user->nama_admin, 0, 1)) }}</div>
            <div class="profile-info-row">
                <div class="info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $user->nama_admin }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-item">
                    <span class="info-label">Username</span>
                    <span class="info-value">{{ $user->username }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $user->email ?: '-' }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-item">
                    <span class="info-label">Role</span>
                    <span class="info-value">
                        <span class="badge-role">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                    </span>
                </div>
                <div class="info-divider"></div>
                <div class="info-item">
                    <span class="info-label">Divisi</span>
                    <span class="info-value">
                        <span class="badge-divisi"><i class="fas fa-building"></i> {{ $user->divisi ?? '-' }}</span>
                    </span>
                </div>
                <div class="info-divider"></div>
                <div class="info-item">
                    <span class="info-label">Bergabung Sejak</span>
                    <span class="info-value">{{ $user->created_at->format('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Ganti Password --}}
    <div class="panel">
        <div class="panel-header">
            <i class="fas fa-lock"></i>
            <h3>Ganti Password</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('anggota.password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Password Lama <span class="req">*</span></label>
                    <input type="password" name="password_lama" class="form-control" required placeholder="Masukkan password lama">
                    @error('password_lama')
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password Baru <span class="req">*</span></label>
                    <input type="password" name="password_baru" class="form-control" required placeholder="Minimal 6 karakter">
                    @error('password_baru')
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru <span class="req">*</span></label>
                    <input type="password" name="password_baru_confirmation" class="form-control" required placeholder="Ulangi password baru">
                </div>
                <ul class="password-hint">
                    <li>Minimal 6 karakter</li>
                    <li>Gunakan kombinasi huruf dan angka</li>
                </ul>
                <br>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-key"></i> Simpan Password Baru
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
