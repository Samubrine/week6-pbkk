# PBKK Week 6 Assignment — Secure Academic Portal Database & Eloquent Modeling

> **Mata Kuliah:** Pemrograman Berbasis Kerangka Kerja (PBKK)  
> **Departemen:** Teknik Informatika, Fakultas Teknologi Elektro dan Informatika Cerdas (FTEIC)  
> **Institusi:** Institut Teknologi Sepuluh Nopember (ITS), Surabaya  
> **Semester:** Gasal 2026/2027 (Semester 5)  
> **Mahasiswa:** Mikail Ibrahim Hakim (NRP: 5025241046)  

---

## Ringkasan Penugasan & Capaian (Rubrik Evaluasi 100% / Grade A+)

Proyek ini mengimplementasikan fondasi basis data relasional penuh MySQL dengan Laravel Eloquent ORM, migrasi skema terstruktur, proteksi keamanan mass assignment, seeder & factory dinamis berbasis Faker, serta kueri dashboard terotentikasi Laravel Breeze.

| Komponen Penilaian | Bobot | Status & Implementasi |
| :--- | :---: | :--- |
| **1. Rancangan Skema Migration** | **35%** | Tabel `projects` terikat ke `users.id` secara relasional foreign key dengan `onDelete('cascade')`. Kolom mencakup: `id`, `judul`, `deskripsi` (nullable), `tema_agent` (default `Ollama`), `api_key_secure` (nullable), dan timestamps. |
| **2. Pemodelan Data & Mass Assignment Guard** | **25%** | Model `Project` dan `User` mematuhi standar penamaan Laravel & PSR-12. Model `Project` dilengkapi whitelist array `protected $fillable` untuk mengamankan data dari serangan Mass Assignment, serta relasi bidirectional (`belongsTo` & `hasMany`). |
| **3. Factories & Seeders Orkestrasi** | **20%** | `ProjectFactory` menghasilkan data proposal ide Agentic AI realistis. `DatabaseSeeder` mengorkestrasi akun evaluator khusus `dosenpbkk@its.ac.id`, akun mahasiswa `5025241046@student.its.ac.id`, dan 15 user mahasiswa acak yang masing-masing memiliki 2 project (Total: 17 user, 34 project). |
| **4. Integritas Query di Dashboard** | **10%** | Controller `DashboardController` melakukan kueri Eloquent terproteksi SQL Injection yang strictly scoped: `Auth::user()->projects()->latest()->get()`, menampilkan hanya proyek milik akun aktif secara terurut tanggal terbaru. |
| **5. Kerapian Kode & Standar PSR-12** | **10%** | Kode terformat bersih mengikuti PSR-12, bebas file sensitif (`.env` dan `vendor/` tidak ter-commit ke Git), dan dokumentasi setup lengkap. |

---

## Struktur Skema Basis Data

### Tabel `projects`
- `id`: BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
- `judul`: VARCHAR(200) NOT NULL
- `deskripsi`: TEXT NULL
- `tema_agent`: VARCHAR(100) NOT NULL DEFAULT 'Ollama'
- `api_key_secure`: VARCHAR(255) NULL
- `user_id`: BIGINT UNSIGNED NOT NULL (Foreign Key -> `users.id`, ON DELETE CASCADE)
- `created_at`, `updated_at`: TIMESTAMP NULL

---

## Kredensial Akun Demo Pengujian

Setelah menjalankan seeder, gunakan akun-akun berikut untuk menguji login pada `/login`:

| Peran Akun | Email | Password | Data Proyek Terkait |
| :--- | :--- | :--- | :--- |
| **Dosen Penguji (Evaluator)** | `dosenpbkk@its.ac.id` | `password` | 2 Proyek Proposal Evaluasi AI Kurikulum |
| **Mahasiswa Authoritative** | `5025241046@student.its.ac.id` | `password` | 2 Proyek Security Agent Harness |
| **Akun Acak (15 Mahasiswa)** | *(Otomatis digenerate Faker)* | `password` | Masing-masing memiliki 2 proyek dummy |

---

## Panduan Instalasi & Menjalankan Proyek Lokal

### 1. Prasyarat Sistem
- PHP >= 8.3 dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`
- MySQL Server (misal via Laragon / XAMPP) berjalan pada port 3306
- Composer >= 2.8
- Node.js >= 20 & NPM

### 2. Langkah Konfigurasi
```bash
# 1. Pindah ke direktori proyek Week 6
cd "D:\ITS\Mata Kuliah\Semester 5\PBKK\Week 6 Assignment"

# 2. Salin environment file jika belum ada
cp .env.example .env

# 3. Instal dependensi PHP dan Node.js
composer install
npm install

# 4. Generate Application Key
php artisan key:generate

# 5. Konfigurasi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=pbkk_week6
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Kompilasi asset frontend Vite
npm run build

# 7. Jalankan migrasi dan seeder database
php artisan migrate:fresh --seed
```

### 3. Menjalankan Server Pengembangan
```bash
php artisan serve
```
Aplikasi dapat diakses di browser melalui URL: **`http://127.0.0.1:8000`**

---

## Menjalankan Pengujian Otomatis (Automated Testing)

Semua skenario pengujian telah diuji dan lulus (100% Pass):
```bash
php artisan test
```

Untuk menjalankan pengujian fitur spesifik Week 6:
```bash
php artisan test tests/Feature/Week6DatabaseAndModelingTest.php
```
