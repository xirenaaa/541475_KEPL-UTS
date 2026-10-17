# Perpustakaan Digital - Digital Library Management System
## Konfigurasi dan Evolusi Perangkat Lunak (KEPL) 2026

**Tema Sistem:** Perpustakaan Digital (Digital Library Management System)  
**Mahasiswa:** Falah Auladi  
**NIM:** 23/541475/SV/25139  
**Program Studi:** Sarjana Terapan Teknologi Rekayasa Perangkat Lunak (TRPL)  
**Departemen:** Teknik Elektro dan Teknologi Informasi, Fakultas Teknik, Universitas Gadjah Mada  
**Repositori GitHub:** [https://github.com/xirenaaa/541475_KEPL-UTS](https://github.com/xirenaaa/541475_KEPL-UTS)  

---

## 1. Ringkasan Eksekutif & Arsitektur Sistem

Sistem ini dibangun untuk memenuhi seluruh kriteria Ujian Tengah Semester mata kuliah Konfigurasi dan Evolusi Perangkat Lunak (KEPL) 2026. Aplikasi terdiri atas:
1. **Backend RESTful API:** Laravel 11/12 yang dilengkapi otentikasi token via Laravel Sanctum, CRUD lengkap entity `Book`, penanganan status HTTP presisi (200, 201, 401, 422), dan 11 feature tests lulus.
2. **Frontend SPA:** Vue.js 3 dengan bundler Vite, Axios dengan auth request & response interceptors, desain visual Bento Grid kontemporer (*Warm Cream Minimalist* Crextio style) dengan navigasi pill tersegmen dan tanpa emotikon, serta konfigurasi URL dinamis via environment variable `VITE_API_BASE_URL`.
3. **Database Relasional:** MySQL 8.0 dengan Named Volume `perpustakaan-db-data` untuk persistensi data setelah container direstart (`docker compose down` dan `docker compose up -d`).
4. **Server Aplikasi Berkinerja Tinggi (Nilai Tambahan +10):** Dijalankan menggunakan **FrankenPHP 1.4 (PHP 8.4)** dengan arsitektur Caddy & Go worker mode, menggantikan server tradisional PHP-FPM / Nginx.
5. **Orkestrasi Container:** Docker Compose (`docker-compose.yml`) yang menjalankan 3 service (`db`, `backend`, `frontend`) dengan satu perintah `docker compose up -d --build`. Seluruh komunikasi antarkontainer menggunakan nama service di jaringan bridge `perpustakaan-net`.
6. **Pipeline CI/CD:** GitHub Actions (`.github/workflows/ci.yml`) dengan 3 jobs:
   - `test-backend`: Menjalankan `php artisan test` pada PHP 8.4 dan SQLite in-memory.
   - `build-frontend`: Menjalankan `npm ci` dan `npm run build` pada Node.js 22.
   - `deploy`: Berjalan hanya pada event push ke branch `main`, membangun image Docker dan mengunggahnya ke GitHub Container Registry (`ghcr.io`) dengan tag nomor commit SHA.

---

## 2. Diagram Aliran Data (Data Flow Pipeline)

```
[ Browser Klien (Vue.js 3 SPA) ]
       │
       │ HTTP Request (JSON) + Header Bearer Token
       ▼
[ Nginx Reverse Proxy (Container: perpustakaan-frontend, Port 80/8080) ]
       │
       │ Proxy Pass: http://backend:8000/api/ (Docker Network: perpustakaan-net)
       ▼
[ FrankenPHP & Laravel 11/12 (Container: perpustakaan-backend, Port 8000) ]
       │
       │ 1. Sanctum Middleware: auth:sanctum memvalidasi token
       │ 2. BookController: Validasi data request (422 jika gagal)
       │ 3. Eloquent ORM: Query SQL (CRUD)
       ▼
[ MySQL 8.0 (Container: perpustakaan-db, Port 3306/3307) ]
       │
       │ Menyimpan data fisik secara persisten
       ▼
[ Docker Named Volume: perpustakaan-db-data ]
```

---

## 3. Panduan Menjalankan Sistem

### Prasyarat
- Docker Desktop (versi 24+ / Docker Compose v2+)
- Port `8080`, `8000`, dan `3307` tersedia pada host.

### Menjalankan dengan Docker Compose (Direkomendasikan)
1. **Clone repositori:**
   ```bash
   git clone https://github.com/xirenaaa/541475_KEPL-UTS.git
   cd 541475_KEPL-UTS
   ```

2. **Siapkan environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Jalankan seluruh service:**
   ```bash
   docker compose up -d --build
   ```

4. **Akses Layanan:**
   - **Frontend Web UI:** `http://localhost:8080`
   - **Backend API:** `http://localhost:8000/api`
   - **Database MySQL:** `localhost:3307`

5. **Kredensial Akun Bawaan (Seeded):**
   - **Email:** `admin@perpustakaan.test`
   - **Password:** `password123`

---

## 4. Pembahasan Tiap Soal & Bukti Pengujian

### Soal 1: Backend Laravel RESTful API (CPMK 1 - Nilai 15)
- **Otentikasi Token:** `POST /api/login` mengembalikan token Sanctum. `POST /api/logout` mencabut token aktif. Rute CRUD `/api/books` dilindungi middleware `auth:sanctum`.
- **Status HTTP & JSON:**
  - `201 Created` saat buku berhasil ditambahkan.
  - `422 Unprocessable Entity` saat validasi gagal (misal kolom judul atau author kosong).
  - `401 Unauthorized` saat request tidak menyertakan token yang valid.
- **Postman Collection:** Tersimpan di `postman/Perpustakaan-API.postman_collection.json` dan `backend/Perpustakaan-API.postman_collection.json`.
- **Feature Tests:** Berkas `tests/Feature/AuthTest.php` dan `tests/Feature/BookTest.php`.

```bash
$ php artisan test
PHPUnit 12.5.40 by Sebastian Bergmann and contributors.

Auth (Tests\Feature\Auth)
 ✔ User can login and receive token
 ✔ Unauthenticated user cannot access books
 ✔ Login fails with wrong credentials

Book (Tests\Feature\Book)
 ✔ Authenticated user can create book
 ✔ Create book validation fails
 ✔ Authenticated user can list books
 ✔ Authenticated user can view book
 ✔ Authenticated user can update book
 ✔ Authenticated user can delete book

Example (Tests\Feature\Example)
 ✔ The application returns a successful response

Example (Tests\Unit\Example)
 ✔ That true is true

OK (11 tests, 27 assertions)
```

---

### Soal 2: Frontend Vue.js (CPMK 1 - Nilai 10)
- **Desain UI Bento Grid Kontemporer:** Mengacu pada standar desain SaaS modern (referensi Crextio) dengan estetika *Warm Cream Minimalist*. Menggunakan palet beige/off-white lembut (`#f5f2eb` / `#fff5d6`), aksen honey amber (`#fbbf24`), navigasi pill tersegmen, kartu modular Bento Grid (Sorotan Koleksi, Aktivitas Mingguan, Timer Sirkulasi, dan SOP Kurasi), serta **bebas emotikon** dengan ikonografi SVG murni.
- **Halaman Login:** Desain minimalis pill di `frontend/src/views/LoginPage.vue`, menyimpan token ke `localStorage`, dan mengalirkan token ke setiap request Axios selanjutnya.
- **Halaman CRUD Buku:** Di `frontend/src/views/BooksPage.vue` untuk melihat data buku, menambah dengan modal, mengubah data, dan menghapus dengan konfirmasi modal.
- **Konfigurasi URL Dinamis:** Menggunakan `import.meta.env.VITE_API_BASE_URL` yang didefinisikan pada `.env` (lokal) atau `/api` (Docker Compose).

---

### Soal 3 & 4: Pengelolaan GitHub & CI/CD Pipeline (CPMK 2 & 3 - Nilai 30)
- **Branching Model:** Branch `main`, `dev`, dan `feature/auth-and-books-crud`.
- **Branch Protection Rules:** Diterapkan pada `main` dan `dev` mewajibkan Pull Request review dan status checks lulus (`Backend Tests` dan `Frontend Build`) sebelum merge.
- **Workflow CI/CD (`.github/workflows/ci.yml`):**
  - Job `test-backend` (`php artisan test`)
  - Job `build-frontend` (`npm ci && npm run build`)
  - Job `deploy`: Hanya berjalan pada push ke `main`, membangun image backend dan frontend, serta mem-push ke `ghcr.io` dengan tag nomor commit SHA.
- **GitHub Secrets:** Kredensial rahasia (`APP_KEY`, `DB_PASSWORD`, `DB_ROOT_PASSWORD`) tidak ada di kode repositori melainkan disimpan di GitHub Secrets.

---

### Soal 5: Dockerfile Backend & Frontend (CPMK 4 & 5 - Nilai 20)
- **Backend Dockerfile:** Menggunakan image versi spesifik `dunglas/frankenphp:1.4-php8.4-bookworm`. `composer.json` dan `composer.lock` disalin terlebih dahulu agar lapisan cache bekerja saat build.
- **Frontend Dockerfile:** Multi-stage build (Stage 1: `node:22-alpine` untuk kompilasi, Stage 2: `nginx:1.27-alpine` untuk melayani web). Image akhir bebas dari `node_modules`.
- **Berkas `.dockerignore`:** Disediakan di `backend/` dan `frontend/` untuk mengabaikan file `.env`, cache, vendor, dan artefak lokal.

---

### Soal 6: Docker Compose (CPMK 6 & 7 - Nilai 25)
- **3 Services:** `db` (MySQL 8.0), `backend` (FrankenPHP Laravel), `frontend` (Nginx Vue).
- **Networking via Service Names:** Terhubung melalui network bridge `perpustakaan-net`.
- **Named Volume Persistence:** Volume `perpustakaan-db-data` menjamin data buku tetap utuh setelah `docker compose down` dan `docker compose up -d`.
- **Lingkungan `.env`:** Kredensial dibaca dari `.env` lokal, dan disediakan `.env.example` sebagai referensi.

```bash
$ docker compose ps
NAME                    IMAGE              COMMAND                  SERVICE    STATUS                    PORTS
perpustakaan-backend    kepluts-backend    "docker-php-entrypoi…"   backend    Up 44 seconds (healthy)   0.0.0.0:8000->8000/tcp
perpustakaan-db         mysql:8.0          "docker-entrypoint.s…"   db         Up 54 seconds (healthy)   0.0.0.0:3307->3306/tcp
perpustakaan-frontend   kepluts-frontend   "/docker-entrypoint.…"   frontend   Up 44 seconds             0.0.0.0:8080->80/tcp
```

---

### Soal 7: Nilai Tambahan (+10) - FrankenPHP Application Server
- Backend dijalankan dengan **FrankenPHP 1.4**, server aplikasi PHP modern berbasis Caddy dan Go Worker Mode.
- **Bukti Respon Header:**
  ```http
  HTTP/1.1 200 OK
  Server: FrankenPHP Caddy
  X-Powered-By: PHP/8.5.11
  ```
- **Bukti Log Container:**
  ```text
  perpustakaan-backend | INFO Server running… Local: http://0.0.0.0:8000
  perpustakaan-backend | INFO #45 vendor/laravel/octane/bin/frankenphp-worker.php(98): frankenphp_handle_request(...)
  ```

---

## 5. Kendala yang Dihadapi & Solusi

1. **Konflik Port 3306 Host:** Laptop pengguna telah menjalankan service MySQL lokal. Solusi: memetakan port host ke `3307:3306` pada `docker-compose.yml`, sementara di dalam jaringan internal Docker komunikasi tetap memakai nama service `db:3306`.
2. **Ekstensi Zip pada Docker Image Debian:** Composer membutuhkan ekstensi `zip` untuk mengunduh paket dari Packagist. Solusi: menambahkan `zip` pada `install-php-extensions` di `backend/Dockerfile`.
3. **Respon JSON saat Token Tidak Ada:** Permintaan tanpa header `Accept` awalnya diarahkan Laravel ke rute `login`. Solusi: memberi nama rute `->name('login')` dan menambahkan exception handler `AuthenticationException` di `bootstrap/app.php` agar selalu menghasilkan balasan `401 {"message":"Unauthenticated."}`.
4. **Validasi Huruf Kecil pada GHCR:** GitHub Container Registry menolak nama image berhuruf kapital. Solusi: menambahkan langkah konversi nama repositori ke huruf kecil (`tr '[:upper:]' '[:lower:]'`) pada workflow CI/CD.
