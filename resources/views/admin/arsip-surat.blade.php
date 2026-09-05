@extends('layouts.admin')
@section('title', 'Arsip Surat - CEKIDOT')
@section('styles')
<style>
.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px}
.page-header h1{font-size:22px;color:#0f3b5e;display:flex;align-items:center;gap:10px;margin:0}
.page-header h1 i{color:#eab308}
.alert{padding:12px 18px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;font-size:14px}
.alert-success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0}
.alert-danger{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px}
.stat-box{background:#fff;border-radius:12px;border:1px solid #e8ecf1;padding:16px 18px;display:flex;align-items:center;gap:12px}
.stat-box .ico{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.stat-box .ico.blue{background:#dbeafe;color:#1d4ed8}
.stat-box .ico.green{background:#d1fae5;color:#065f46}
.stat-box .ico.orange{background:#fef3c7;color:#b45309}
.stat-box .ico.purple{background:#ede9fe;color:#7c3aed}
.stat-box .num{font-size:22px;font-weight:800;color:#0f172a;line-height:1}
.stat-box .lbl{font-size:12px;color:#94a3b8;margin-top:2px}
.explorer-wrap{display:grid;grid-template-columns:220px 1fr;gap:0;background:#fff;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden;min-height:500px}
.explorer-sidebar{background:#f8fafc;border-right:1px solid #e2e8f0;padding:12px 0}
.sidebar-title{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.8px;padding:6px 16px 10px}
.sidebar-item{display:flex;align-items:center;gap:10px;padding:9px 16px;cursor:pointer;font-size:13px;font-weight:500;color:#334155;transition:all 0.15s;border-left:3px solid transparent}
.sidebar-item:hover{background:#eef2f7;color:#0f3b5e}
.sidebar-item.active{background:#e0eaf4;color:#0f3b5e;font-weight:700;border-left-color:#0f3b5e}
.sidebar-item i{width:16px;text-align:center}
.sidebar-item .badge{margin-left:auto;background:#e2e8f0;color:#475569;font-size:10px;font-weight:700;padding:1px 8px;border-radius:10px}
.sidebar-item.active .badge{background:#0f3b5e;color:#fff}
.explorer-main{display:flex;flex-direction:column}
.explorer-toolbar{display:flex;align-items:center;gap:10px;padding:12px 16px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap}
.explorer-toolbar .path{font-size:13px;color:#64748b;display:flex;align-items:center;gap:6px;flex:1}
.explorer-toolbar .path i{color:#eab308}
.explorer-toolbar .path strong{color:#0f3b5e}
.tb-btn{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:7px;font-size:12px;font-weight:600;border:none;cursor:pointer;text-decoration:none;transition:all 0.2s}
.tb-btn.primary{background:#0f3b5e;color:#fff}
.tb-btn.primary:hover{background:#0a2a44}
.tb-btn.gray{background:#f1f5f9;color:#334155}
.tb-btn.gray:hover{background:#e2e8f0}
.search-box{display:flex;align-items:center;border:1.5px solid #e2e8f0;border-radius:8px;overflow:hidden;background:#fff}
.search-box input{border:none;outline:none;padding:6px 10px;font-size:13px;width:180px;font-family:inherit}
.search-box button{background:#f1f5f9;border:none;padding:6px 10px;cursor:pointer;color:#64748b}
.file-panel{flex:1;overflow-y:auto}
.file-list-header{display:grid;grid-template-columns:2fr 1fr 1fr 1fr 100px;gap:0;padding:8px 16px;background:#f8fafc;border-bottom:1px solid #e2e8f0;font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.4px}
.file-row{display:grid;grid-template-columns:2fr 1fr 1fr 1fr 100px;gap:0;padding:10px 16px;border-bottom:1px solid #f8fafc;align-items:center;transition:background 0.1s;font-size:13px}
.file-row:hover{background:#f0f6ff}
.file-row:last-child{border-bottom:none}
.file-row .file-name{display:flex;align-items:center;gap:10px;font-weight:500;color:#1e293b}
.file-row .file-name i{font-size:20px;flex-shrink:0}
.file-row .file-name .meta{font-size:11px;color:#94a3b8;font-weight:400;margin-top:1px}
.file-row .file-type span{padding:2px 10px;border-radius:10px;font-size:11px;font-weight:600}
.file-row .file-type span.masuk{background:#dbeafe;color:#1d4ed8}
.file-row .file-type span.keluar{background:#fef3c7;color:#b45309}
.file-row .file-type span.internal{background:#ede9fe;color:#7c3aed}
.file-row .actions{display:flex;gap:6px;justify-content:flex-end}
.act-btn{width:28px;height:28px;border-radius:6px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:12px;text-decoration:none;transition:all 0.2s}
.act-btn.dl{background:#d1fae5;color:#065f46}
.act-btn.dl:hover{background:#a7f3d0}
.act-btn.del{background:#fef2f2;color:#dc2626}
.act-btn.del:hover{background:#fecaca}
.empty-folder{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 20px;color:#94a3b8}
.empty-folder i{font-size:48px;opacity:0.2;margin-bottom:12px}
.upload-panel{padding:20px;border-top:1px solid #e2e8f0;background:#fafbfc}
.upload-panel h4{font-size:14px;font-weight:700;color:#0f3b5e;margin-bottom:14px;display:flex;align-items:center;gap:8px}
.upload-panel h4 i{color:#eab308}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px}
.form-row.full{grid-template-columns:1fr}
.fg label{font-size:12px;font-weight:600;color:#334155;display:block;margin-bottom:4px}
.fg input,.fg select,.fg textarea{width:100%;padding:7px 10px;border:1.5px solid #e2e8f0;border-radius:7px;font-size:13px;font-family:inherit;background:#fff}
.fg input:focus,.fg select:focus{outline:none;border-color:#0f3b5e}
.modal-ov{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);backdrop-filter:blur(4px);z-index:9999;align-items:center;justify-content:center;padding:20px}
.modal-ov.show{display:flex}
.modal-bx{background:#fff;border-radius:16px;max-width:400px;width:100%;padding:28px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.25)}
.modal-bx .ico-del{font-size:48px;color:#dc2626;margin-bottom:10px}
.modal-bx h3{font-size:18px;color:#1e293b;margin-bottom:6px}
.modal-bx p{font-size:13px;color:#64748b;margin-bottom:20px}
.modal-bx .acts{display:flex;gap:10px;justify-content:center}
.modal-bx .acts button,.modal-bx .acts a{padding:9px 22px;border-radius:8px;font-weight:600;font-size:13px;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:6px}
.modal-bx .acts .cancel{background:#f1f5f9;color:#334155}
.modal-bx .acts .confirm{background:#dc2626;color:#fff}
@media(max-width:992px){.stats-row{grid-template-columns:repeat(2,1fr)}.explorer-wrap{grid-template-columns:1fr}.explorer-sidebar{border-right:none;border-bottom:1px solid #e2e8f0;display:flex;flex-wrap:wrap;padding:8px}.sidebar-item{border-left:none;border-radius:8px}.file-list-header{display:none}.file-row{grid-template-columns:1fr;gap:4px;padding:12px 16px}.file-row>div:not(.file-name){padding-left:30px;font-size:12px}.file-row .actions{padding-left:0;justify-content:flex-start;margin-top:6px}}
</style>
@endsection

@section('content')
@php $user = auth()->user(); @endphp

<div class="page-header">
    <div>
        <h1><i class="fas fa-archive"></i> Arsip Surat</h1>
        <span style="font-size:13px;color:#64748b;">{{ $user->isSuperAdmin() ? 'Semua Divisi' : 'Divisi '.$user->divisi }}</span>
    </div>
    <div style="font-size:13px;color:#64748b;"><i class="fas fa-user-circle" style="color:#eab308"></i> {{ $user->nama_admin }}</div>
</div>

@if(session('success'))<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
@if($errors->any())<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>@endif

<div class="stats-row">
    <div class="stat-box"><div class="ico blue"><i class="fas fa-file-alt"></i></div><div><div class="num">{{ $totalArsip }}</div><div class="lbl">Total Arsip</div></div></div>
    <div class="stat-box"><div class="ico green"><i class="fas fa-arrow-down"></i></div><div><div class="num">{{ $totalMasuk }}</div><div class="lbl">Surat Masuk</div></div></div>
    <div class="stat-box"><div class="ico orange"><i class="fas fa-arrow-up"></i></div><div><div class="num">{{ $totalKeluar }}</div><div class="lbl">Surat Keluar</div></div></div>
    <div class="stat-box"><div class="ico purple"><i class="fas fa-folder"></i></div><div><div class="num">{{ $totalInternal }}</div><div class="lbl">Internal</div></div></div>
</div>

<div class="explorer-wrap">
    <div class="explorer-sidebar">
        <div class="sidebar-title">Folder Arsip</div>
        <div class="sidebar-item active" data-folder="semua" onclick="switchFolder('semua',this)">
            <i class="fas fa-folder-open" style="color:#eab308"></i> Semua
            <span class="badge">{{ $totalArsip }}</span>
        </div>
        <div class="sidebar-item" data-folder="masuk" onclick="switchFolder('masuk',this)">
            <i class="fas fa-arrow-down" style="color:#1d4ed8"></i> Surat Masuk
            <span class="badge">{{ $totalMasuk }}</span>
        </div>
        <div class="sidebar-item" data-folder="keluar" onclick="switchFolder('keluar',this)">
            <i class="fas fa-arrow-up" style="color:#b45309"></i> Surat Keluar
            <span class="badge">{{ $totalKeluar }}</span>
        </div>
        <div class="sidebar-item" data-folder="internal" onclick="switchFolder('internal',this)">
            <i class="fas fa-folder" style="color:#7c3aed"></i> Internal
            <span class="badge">{{ $totalInternal }}</span>
        </div>
        <div class="sidebar-title" style="margin-top:12px">Aksi</div>
        <div class="sidebar-item" onclick="toggleUpload()">
            <i class="fas fa-cloud-upload-alt" style="color:#0f3b5e"></i> Upload Arsip
        </div>
        @if($user->isSuperAdmin())
        <div class="sidebar-item" onclick="window.open('{{ route('admin.arsip.cetak') }}','_blank')">
            <i class="fas fa-print" style="color:#065f46"></i> Cetak Laporan
        </div>
        @endif
    </div>

    <div class="explorer-main">
        <div class="explorer-toolbar">
            <div class="path"><i class="fas fa-hdd"></i> Arsip &rsaquo; <strong id="pathLabel">Semua</strong></div>
            <form method="GET" action="{{ route('admin.arsip.index') }}" style="display:flex;gap:6px;align-items:center;">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Cari arsip..." value="{{ request('search') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                @if(request('search'))<a href="{{ route('admin.arsip.index') }}" class="tb-btn gray"><i class="fas fa-times"></i></a>@endif
            </form>
        </div>

        <div class="file-panel">
            <div class="file-list-header">
                <div>Nama / Perihal</div>
                <div>Nomor Surat</div>
                <div>Jenis</div>
                <div>Tanggal</div>
                <div style="text-align:right">Aksi</div>
            </div>

            @php
                $grouped = ['semua' => $arsip->items(), 'masuk' => [], 'keluar' => [], 'internal' => []];
                foreach($arsip->items() as $s) { $grouped[$s->jenis_surat][] = $s; }
            @endphp

            @foreach(['semua','masuk','keluar','internal'] as $folder)
            <div class="folder-content" id="folder-{{ $folder }}" style="{{ $folder !== 'semua' ? 'display:none' : '' }}">
                @if(empty($grouped[$folder]))
                <div class="empty-folder"><i class="fas fa-folder-open"></i><p>Folder kosong</p></div>
                @else
                @foreach($grouped[$folder] as $s)
                @php $ext = strtolower(pathinfo($s->file_name, PATHINFO_EXTENSION)); @endphp
                <div class="file-row">
                    <div class="file-name">
                        <i class="fas fa-file-{{ $ext==='pdf' ? 'pdf' : (in_array($ext,['jpg','jpeg','png']) ? 'image' : 'alt') }}" style="color:{{ $ext==='pdf' ? '#dc2626' : '#0f3b5e' }}"></i>
                        <div>
                            <div>{{ $s->perihal }}</div>
                            <div class="meta">{{ $s->file_name }} &bull; {{ $s->file_size ? number_format($s->file_size/1024,1).'KB' : '-' }} &bull; {{ $s->uploader->nama_admin ?? '-' }}</div>
                        </div>
                    </div>
                    <div style="font-size:13px;color:#475569;">{{ $s->nomor_surat }}</div>
                    <div class="file-type"><span class="{{ $s->jenis_surat }}">{{ ucfirst($s->jenis_surat) }}</span></div>
                    <div style="font-size:13px;color:#475569;">{{ $s->tanggal_surat->format('d M Y') }}</div>
                    <div class="actions">
                        <a href="{{ route('admin.arsip.download', $s->id) }}" class="act-btn dl" title="Unduh"><i class="fas fa-download"></i></a>
                        @if($user->isSuperAdmin() || $s->uploaded_by === $user->id)
                        <button class="act-btn del" onclick="openDel({{ $s->id }},'{{ addslashes($s->nomor_surat) }}')" title="Hapus"><i class="fas fa-trash"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @endforeach
        </div>

        <div class="upload-panel" id="uploadPanel" style="display:none">
            <h4><i class="fas fa-cloud-upload-alt"></i> Upload Arsip Baru</h4>
            <form method="POST" action="{{ route('admin.arsip.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="fg"><label>Nomor Surat *</label><input type="text" name="nomor_surat" required placeholder="005/DISPAR/2026"></div>
                    <div class="fg"><label>Tanggal Surat *</label><input type="date" name="tanggal_surat" required></div>
                </div>
                <div class="form-row full">
                    <div class="fg"><label>Perihal *</label><input type="text" name="perihal" required placeholder="Perihal surat"></div>
                </div>
                <div class="form-row">
                    <div class="fg"><label>Jenis Surat *</label>
                        <select name="jenis_surat" required>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                            <option value="internal">Internal</option>
                        </select>
                    </div>
                    @if($user->isSuperAdmin())
                    <div class="fg"><label>Divisi *</label>
                        <select name="divisi" required>
                            <option value="">-- Pilih --</option>
                            @foreach($divisi_list as $d)<option value="{{ $d }}">{{ $d }}</option>@endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="form-row">
                    <div class="fg"><label>File * (PDF/JPG/PNG/DOC, maks 10MB)</label><input type="file" name="file_surat" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"></div>
                    <div class="fg"><label>Keterangan</label><input type="text" name="keterangan" placeholder="Opsional"></div>
                </div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <button type="submit" class="tb-btn primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="tb-btn gray" onclick="toggleUpload()">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal-ov" id="delModal">
    <div class="modal-bx">
        <div class="ico-del"><i class="fas fa-trash-alt"></i></div>
        <h3>Hapus Arsip?</h3>
        <p id="delMsg">Tindakan ini tidak dapat dibatalkan.</p>
        <form method="POST" action="{{ route('admin.arsip.destroy') }}">
            @csrf
            <input type="hidden" name="delete_id" id="delId">
            <div class="acts">
                <button type="button" class="cancel" onclick="closeDel()">Batal</button>
                <button type="submit" class="confirm"><i class="fas fa-trash"></i> Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
var labels={semua:"Semua",masuk:"Surat Masuk",keluar:"Surat Keluar",internal:"Internal"};
function switchFolder(f,el){
    document.querySelectorAll(".sidebar-item").forEach(function(i){i.classList.remove("active")});
    el.classList.add("active");
    document.querySelectorAll(".folder-content").forEach(function(d){d.style.display="none"});
    document.getElementById("folder-"+f).style.display="block";
    document.getElementById("pathLabel").textContent=labels[f];
}
function toggleUpload(){
    var p=document.getElementById("uploadPanel");
    p.style.display=p.style.display==="none"?"block":"none";
}
function openDel(id,nomor){
    document.getElementById("delId").value=id;
    document.getElementById("delMsg").textContent="Hapus arsip \""+nomor+"\"?";
    document.getElementById("delModal").classList.add("show");
    document.body.style.overflow="hidden";
}
function closeDel(){
    document.getElementById("delModal").classList.remove("show");
    document.body.style.overflow="auto";
}
document.addEventListener("keydown",function(e){if(e.key==="Escape")closeDel()});
document.addEventListener("DOMContentLoaded",function(){
    var alerts=document.querySelectorAll(".alert");
    alerts.forEach(function(a){setTimeout(function(){a.style.transition="opacity 0.5s";a.style.opacity="0";setTimeout(function(){a.remove()},500)},3000)});
});
</script>
@endsection
