# Panduan Deploy ke cPanel

## Alur Kerja Sehari-hari

```
Lokal (development)
    ↓ git add . && git commit -m "..." && git push
GitHub (kode saja, tanpa file uploads)
    ↓ download zip dari GitHub / git pull di server
cPanel (production)
```

## Yang Masuk GitHub ✅
- Semua kode PHP (app/, routes/, resources/, config/, database/)
- File konfigurasi (.env.example, composer.json, dll)
- **TIDAK termasuk file uploads** (sudah di .gitignore)

## Yang TIDAK Masuk GitHub ❌
```
storage/app/public/uploads/   ← file PDF/dokumen user
vendor/
node_modules/
.env
public/storage (symlink)
```

---

## Cara Deploy ke cPanel

### Pertama kali (fresh install):

1. Di cPanel File Manager, upload semua file kode
2. Buka cPanel Terminal:
```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
cp .env.example .env
# Edit .env: isi DB_*, APP_URL, APP_KEY
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Update berikutnya (sudah ada data):

1. Download zip dari GitHub (Code → Download ZIP)
2. Extract di lokal, **hapus folder** `storage/app/public/uploads/` dari hasil extract
3. Upload ke cPanel (timpa file lama)
4. Di cPanel Terminal:
```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**JANGAN jalankan `storage:link` lagi kalau sudah ada** — cukup sekali.

---

## Aturan Penting

- **Jangan pernah hapus** `storage/app/public/uploads/` di server
- **Jangan pernah** `php artisan migrate:fresh` di production (data hilang)
- Sebelum deploy, backup database dulu via cPanel → phpMyAdmin → Export

---

## Limit Upload File

| Tipe | Limit |
|------|-------|
| Dokumen Anggota | 10 MB |
| Dokumen AKIP | 10 MB |
| Dokumen IKI | 10 MB |
| Slider | 2 MB |
| Surat Masuk | 5 MB |

Format yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, ZIP, RAR
