# Perpustakaan Digital - Backend RESTful API

Backend berbasis Laravel 11/12 yang menyediakan layanan RESTful API untuk sistem manajemen perpustakaan.

## Fitur Utama
- **Autentikasi Token:** Menggunakan Laravel Sanctum (`/api/login`, `/api/logout`, `/api/register`).
- **Resource CRUD:** Manajemen katalog buku lengkap (`/api/books`).
- **Respon Terstandar:** Format JSON dengan status code HTTP presisi (200, 201, 401, 422).
- **Server Kinerja Tinggi:** Dijalankan dengan FrankenPHP (Laravel Octane).
- **Feature Tests:** Pengujian otomatis via PHPUnit (`php artisan test`).

## Menjalankan Secara Lokal
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Pengujian
```bash
php artisan test
```
