# PANDUAN DEPLOY CEKIDOT KE cPANEL (VIA GITHUB)
# Dibuat: September 2026
# =====================================================

## GAMBARAN UMUM
- Kode PHP/blade  → push via GitHub → pull di cPanel
- Database        → import manual via phpMyAdmin di cPanel
- File upload     → upload manual via cPanel File Manager
- .env            → buat manual di cPanel (TIDAK ikut GitHub)

## APAKAH WEB LAMA TERTIMPA?
- Kode lama      → YA, tertimpa dengan kode baru ✅
- Database lama  → TIDAK tertimpa otomatis (kamu yang kontrol)
- File upload    → TIDAK tertimpa (aman)
- .env lama      → TIDAK tertimpa (aman)

=====================================================
## LANGKAH 1 — PUSH KODE KE GITHUB (dari laptop kamu)
=====================================================

Buka terminal di folder project, jalankan:

    git add -A
    git commit -m "deploy: versi terbaru cekidot"
    git push

Kalau muncul error 403 (akses ditolak), minta Ratih tambahkan
kamu sebagai Collaborator di GitHub repo-nya dulu.

=====================================================
## LANGKAH 2 — MASUK cPANEL
=====================================================

1. Buka https://yourdomain.com/cpanel
2. Login dengan username & password cPanel

=====================================================
## LANGKAH 3 — PULL KODE DARI GITHUB KE cPANEL
=====================================================

Ada 2 cara tergantung cPanel kamu support apa:

### CARA A — Via Terminal/SSH cPanel (paling mudah)
1. Di cPanel → cari "Terminal" atau "SSH Access"
2. Masuk ke folder web:
       cd public_html
   (atau folder sesuai domain kamu)

3. Kalau PERTAMA KALI (belum ada repo):
       git clone https://github.com/ayuratih425/cekidots.git .
   (titik di akhir artinya clone ke folder saat ini)

4. Kalau SUDAH ADA sebelumnya (update/timpa):
       git pull origin main

### CARA B — Via Git Version Control di cPanel
1. Di cPanel → cari "Git Version Control"
2. Klik "Create" → isi:
   - Clone URL: https://github.com/ayuratih425/cekidots.git
   - Repository Path: /home/username/public_html
3. Klik "Create" → tunggu selesai
4. Untuk update berikutnya: klik "Pull or Deploy"

=====================================================
## LANGKAH 4 — BUAT FILE .env DI cPANEL
=====================================================

1. Di cPanel → File Manager → masuk ke folder project
2. Buat file baru bernama ".env"
3. Isi dengan (sesuaikan dengan data cPanel kamu):

----------------------------------------------------
APP_NAME=CEKIDOT
APP_ENV=production
APP_KEY=                          ← dikosongkan dulu, diisi nanti
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_cpanel  ← lihat di cPanel > MySQL Databases
DB_USERNAME=user_database_cpanel  ← lihat di cPanel > MySQL Databases
DB_PASSWORD=password_database     ← password yang kamu buat

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true

FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
CACHE_STORE=file
----------------------------------------------------

=====================================================
## LANGKAH 5 — BUAT DATABASE DI cPANEL
=====================================================

1. cPanel → MySQL Databases
2. Buat database baru, contoh: "dism4551_cekidot"
3. Buat user baru, contoh: "dism4551_user"
4. Beri password yang kuat
5. Tambahkan user ke database → centang "ALL PRIVILEGES"
6. Catat nama DB, username, password → isi ke .env

=====================================================
## LANGKAH 6 — IMPORT DATABASE
=====================================================

1. cPanel → phpMyAdmin
2. Klik database yang baru dibuat (kiri)
3. Klik tab "Import"
4. Pilih file: "localhost (1).sql" dari laptop kamu
5. Klik "Go" / "Import"
6. Tunggu sampai selesai (muncul pesan sukses hijau)

CATATAN: File ini berisi semua data terbaru termasuk
users, slider, folder, dan semua konfigurasi.

=====================================================
## LANGKAH 7 — JALANKAN PERINTAH ARTISAN VIA SSH
=====================================================

Di Terminal cPanel, masuk ke folder project:

    cd public_html   (atau sesuai folder kamu)

Jalankan satu per satu:

    # Generate app key
    php artisan key:generate

    # Buat symlink storage
    php artisan storage:link

    # Optimasi untuk production
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan optimize

=====================================================
## LANGKAH 8 — BUAT FOLDER UPLOAD
=====================================================

Di Terminal cPanel:

    mkdir -p storage/app/public/uploads/slider
    mkdir -p storage/app/public/uploads/anggota
    mkdir -p storage/app/public/arsip
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache

=====================================================
## LANGKAH 9 — UPLOAD GAMBAR SLIDER
=====================================================

1. cPanel → File Manager
2. Masuk ke: storage/app/public/uploads/slider/
3. Upload file-file ini dari laptop kamu:
   - 1785256060_Cekidot.png
   - slide.png
   - slide2.png
   - slide3.png

(File ada di: D:\laragon\laragon\www\cekidot\storage\app\public\uploads\slider\)

=====================================================
## LANGKAH 10 — ARAHKAN DOCUMENT ROOT KE /public
=====================================================

PENTING! Laravel harus dijalankan dari folder /public

Di cPanel → Domains → pilih domain → Edit Document Root:
Ubah dari: /public_html
Menjadi:   /public_html/public

ATAU jika tidak bisa ubah document root, buat file
.htaccess di root folder dengan isi:

    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]

=====================================================
## LANGKAH 11 — CEK AKHIR
=====================================================

Buka web di browser, pastikan:
- [ ] Halaman home tampil normal
- [ ] Slider muncul
- [ ] Login admin berhasil (cek username di database)
- [ ] Upload file berhasil
- [ ] Tidak ada error 500
- [ ] URL pakai HTTPS (gembok hijau)

Kalau ada error 500:
- Cek .env sudah benar
- Cek APP_KEY sudah terisi
- Cek permission storage: chmod -R 775 storage

=====================================================
## UNTUK UPDATE KODE BERIKUTNYA (setelah deploy pertama)
=====================================================

Dari laptop:
    git add -A
    git commit -m "update: deskripsi perubahan"
    git push

Di cPanel Terminal:
    cd public_html
    git pull origin main
    php artisan config:cache
    php artisan optimize

Selesai! Tidak perlu import database lagi kecuali ada
perubahan struktur tabel (migrasi baru).

=====================================================
## CATATAN PENTING
=====================================================

1. File .env JANGAN pernah di-push ke GitHub
2. Folder storage/app/public/uploads JANGAN di-push
3. Backup database cPanel rutin via phpMyAdmin > Export
4. Kalau ada migrasi baru: php artisan migrate --force
