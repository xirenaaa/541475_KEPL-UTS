# Perpustakaan Digital - Frontend SPA

Antarmuka web SPA (Single Page Application) berbasis Vue 3 dan Vite untuk sistem manajemen perpustakaan digital.

## Fitur
- **Autentikasi Token:** Halaman login dengan integrasi Laravel Sanctum dan penyimpanan token di `localStorage`.
- **Manajemen Buku:** CRUD lengkap (katalog buku, tambah buku modal, ubah buku modal, dan konfirmasi hapus).
- **Desain Kontemporer:** UI Bento Grid modern bernuansa *Warm Cream Minimalist* (referensi Crextio), kartu modular, dan ikonografi SVG murni (tanpa emotikon).
- **URL API Dinamis:** Menggunakan `import.meta.env.VITE_API_BASE_URL` (`.env` atau `/api` saat Docker Compose).

## Pengembangan Lokal
```bash
npm install
npm run dev
```

## Kompilasi Produksi
```bash
npm run build
```

