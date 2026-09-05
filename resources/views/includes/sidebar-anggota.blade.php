@php $user = auth()->user(); @endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="{{ asset('assets/img/logo-sulteng.png') }}" alt="Logo"
                onerror="this.style.display='none';this.parentElement.innerHTML='<span style=\'font-size:26px;font-weight:900;color:#eab308;\'>C</span>'">
        </div>
        <div class="brand-text">
            <h2>CEK<span>IDOT</span></h2>
            <small>Portal Anggota</small>
        </div>
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">{{ strtoupper(substr($user?->nama_admin ?? 'A', 0, 1)) }}</div>
        <div class="user-info">
            <div class="user-name">{{ $user?->nama_admin ?? 'Anggota' }}</div>
            <div class="user-role">Divisi {{ $user?->divisi ?? '-' }}</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav-list">

            <li>
                <a href="{{ route('anggota.dashboard') }}" class="{{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section">DOKUMEN</li>

            <li>
                <a href="{{ route('anggota.upload') }}" class="{{ request()->routeIs('anggota.upload') ? 'active' : '' }}">
                    <i class="fas fa-cloud-upload-alt"></i><span>Upload Dokumen</span>
                </a>
            </li>

            <li class="nav-section">AKUN</li>

            <li>
                <a href="{{ route('anggota.profil') }}" class="{{ request()->routeIs('anggota.profil') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i><span>Profil Saya</span>
                </a>
            </li>

            <li class="nav-divider"></li>
            <li>
                <a href="{{ route('logout') }}" style="color:#ef4444;">
                    <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="datetime">
            <span><i class="fas fa-calendar-alt"></i> {{ date('d M Y') }}</span>
            <span><i class="fas fa-clock"></i> <span id="sidebarClock">--:--:--</span></span>
        </div>
    </div>
</aside>

<style>
.sidebar {
    width: 260px;
    min-height: 100vh;
    background: linear-gradient(180deg, #0f3b5e 0%, #0a2a44 100%);
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0; top: 0; bottom: 0;
    z-index: 100;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.1) transparent;
    transition: width 0.3s ease;
}
.sidebar::-webkit-scrollbar { width: 4px; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 20px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    flex-shrink: 0;
}
.sidebar-brand .brand-logo {
    width: 40px; height: 40px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.sidebar-brand .brand-logo img { width: 28px; height: 28px; object-fit: contain; }
.sidebar-brand .brand-text h2 { font-size: 18px; font-weight: 800; color: #fff; letter-spacing: 1px; line-height: 1.2; }
.sidebar-brand .brand-text h2 span { color: #eab308; }
.sidebar-brand .brand-text small { font-size: 10px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; }

.sidebar-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    background: rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    flex-shrink: 0;
}
.sidebar-user .user-avatar {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #eab308, #f59e0b);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 800; color: #0f3b5e;
    flex-shrink: 0;
}
.sidebar-user .user-name { font-size: 13px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 160px; }
.sidebar-user .user-role { font-size: 10px; color: rgba(255,255,255,0.4); }

.sidebar-nav { flex: 1; padding: 12px 0; }
.nav-list { list-style: none; padding: 0; margin: 0; }

.nav-section {
    font-size: 9px;
    font-weight: 700;
    color: rgba(255,255,255,0.25);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    padding: 14px 20px 4px;
}

.nav-list > li > a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 500;
    transition: all 0.2s;
    border-left: 3px solid transparent;
}
.nav-list > li > a:hover {
    background: rgba(255,255,255,0.07);
    color: #fff;
    border-left-color: rgba(234,179,8,0.5);
}
.nav-list > li > a.active {
    background: rgba(234,179,8,0.12);
    color: #eab308;
    border-left-color: #eab308;
    font-weight: 600;
}
.nav-list > li > a i { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }

.nav-divider { height: 1px; background: rgba(255,255,255,0.08); margin: 8px 16px; }

.sidebar-footer {
    padding: 12px 20px;
    border-top: 1px solid rgba(255,255,255,0.08);
    flex-shrink: 0;
}
.sidebar-footer .datetime {
    display: flex;
    flex-direction: column;
    gap: 3px;
    font-size: 11px;
    color: rgba(255,255,255,0.3);
}
.sidebar-footer .datetime span { display: flex; align-items: center; gap: 6px; }
.sidebar-footer .datetime i { width: 12px; }
</style>

<script>
(function tick() {
    var el = document.getElementById('sidebarClock');
    if (el) el.textContent = new Date().toLocaleTimeString('id-ID');
    setTimeout(tick, 1000);
})();
</script>
