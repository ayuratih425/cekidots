# PANDUAN DEPLOY CEKIDOT KE cPANEL

## SEBELUM PUSH KE GITHUB

Pastikan file-file ini TIDAK ikut di-push:
- .env (sudah di .gitignore ✅)
- /storage/app/public/uploads (sudah di .gitignore ✅)
- /vendor (sudah di .gitignore ✅)
- /node_modules (sudah di .gitignore ✅)

---

## LANGKAH DEPLOY DI cPANEL

### 1. Upload File
- Upload semua file ke folder `public_html/cekidot` (atau root jika domain utama)
- JANGAN upload folder: vendor, node_modules, storage/app/public/uploads

### 2. Buat .env di Server
Buat file `.env` berdasarkan `.env.production.example`, isi dengan:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_DATABASE=nama_db_cpanel
DB_USERNAME=user_db_cpanel
DB_PASSWORD=password_db_cpanel
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
```

### 3. Install Dependencies via SSH
```bash
composer install --optimize-autoloader --no-dev
```

### 4. Generate Key (jika belum ada)
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi
```bash
php artisan migrate --force
```

### 6. Buat Storage Link
```bash
php artisan storage:link
```

### 7. Buat folder uploads manual
```bash
mkdir -p storage/app/public/uploads/slider
mkdir -p storage/app/public/uploads/anggota
mkdir -p storage/app/public/uploads/akip
mkdir -p storage/app/public/uploads/iki
mkdir -p storage/app/public/arsip
```

### 8. Set Permission
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 9. Optimasi Cache Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 10. Upload Gambar Slider Manual
Upload file-file ini ke `storage/app/public/uploads/slider/`:
- 1785256060_Cekidot.png
- slide.png
- slide2.png
- slide3.png

### 11. Seed Data Awal (jika database baru)
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=SliderSeeder
```

---

## KONFIGURASI cPANEL TAMBAHAN

### Document Root
Arahkan document root ke folder `public/` bukan root project.
Di cPanel: Domains → Manage → Document Root → ubah ke `/public_html/cekidot/public`

### PHP Version
Gunakan PHP 8.2 atau 8.3

### PHP Extensions yang dibutuhkan
- pdo_mysql
- mbstring
- openssl
- tokenizer
- xml
- ctype
- json
- bcmath
- fileinfo

---

## SETELAH DEPLOY — CEK INI

- [ ] Buka web, pastikan tidak ada error
- [ ] Login admin berhasil
- [ ] Upload file berhasil
- [ ] Slider tampil
- [ ] APP_DEBUG=false (tidak ada stack trace di error)
- [ ] HTTPS aktif (gembok hijau di browser)

---

## AKUN DEFAULT ADMIN
Username: admin
Password: (sesuai UserSeeder)
