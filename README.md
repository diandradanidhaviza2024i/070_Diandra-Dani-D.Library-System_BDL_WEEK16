📚 Library System — Sistem Perpustakaan Kampus

Aplikasi Web PHP + MySQL
Prodi Manajemen Informatika

📝 Deskripsi Singkat

Library System adalah aplikasi web berbasis PHP, MySQL/MariaDB, dan JavaScript yang dirancang untuk mengelola proses administrasi perpustakaan kampus.
Sistem ini dibuat sebagai proyek mata kuliah Basis Data Lanjut (BDL) untuk Prodi Manajemen Informatika, dan mencakup fitur lengkap seperti:

Manajemen data mahasiswa

Manajemen buku

Sistem peminjaman & pengembalian buku

Aplikasi ini dirancang agar perpustakaan dapat mengelola data secara efektif, cepat, dan dengan antarmuka yang mudah digunakan.

✨ Fitur-Fitur Utama
📌 1. Manajemen Mahasiswa (CRUD)

Tambah mahasiswa

Edit data mahasiswa

Hapus mahasiswa

Lihat daftar mahasiswa

Pencarian berdasarkan NIM / nama

📌 2. Manajemen Buku (CRUD)

Tambah buku baru

Edit data buku

Hapus buku

Lihat daftar buku

Pencarian berdasarkan judul / kategori / penulis

📌 3. Sistem Peminjaman Buku

Peminjaman buku (stok berkurang otomatis)

Pengembalian buku (stok meningkat otomatis)

Validasi ketersediaan buku

Riwayat peminjaman lengkap

Status peminjaman (dipinjam / dikembalikan)

📌 4. Fitur Database Tingkat Lanjut

Aplikasi ini menerapkan fitur SQL Advanced:

View → Menyajikan data peminjaman lengkap

Stored Procedure → Memproses peminjaman dan pengembalian

Function → Mengecek stok buku

Trigger → Update stok otomatis ketika pinjam/kembali

📌 5. Tampilan Web Modern

Desain sederhana dan mudah dipahami

Navigasi cepat (Mahasiswa, Buku, Peminjaman)

Dark Mode & Light Mode (JavaScript toggle)

Responsif di laptop dan mobile

🗂️ Struktur Proyek
/root
│── index.php
│── mahasiswa/
│── buku/
│── peminjaman/
│── assets/
│    ├── css/
│    └── js/
│── config/
│── sql/
│── README.md

🔧 Teknologi yang Digunakan
Teknologi	Fungsi
PHP 7+	Back-end & CRUD
MySQL / MariaDB	Sistem database
HTML5 + CSS3	Struktur & tampilan
JavaScript	Interaksi UI (Dark/Light Mode, dll.)
Bootstrap (opsional)	Styling & responsif
Advanced SQL	View, Procedure, Function, Trigger
🚀 Cara Menjalankan Aplikasi
1️⃣ Install software pendukung

XAMPP / Laragon / MAMP

2️⃣ Pindahkan project ke direktori server
htdocs/library-system

3️⃣ Buat database
CREATE DATABASE library_db;

4️⃣ Import file SQL

Import file .sql yang ada di folder:

/sql/

5️⃣ Sesuaikan konfigurasi database

Edit file:

config/db.php

6️⃣ Jalankan aplikasi di browser
http://localhost/library-system

🎓 Tujuan Pembuatan Project

Untuk memenuhi tugas mata kuliah Basis Data Lanjut

Latihan membuat aplikasi web CRUD lengkap

Implementasi fitur View, Procedure, Function, Trigger

Menjadi contoh aplikasi sistem perpustakaan kampus

👨‍💻 Pembuat

Diandra Dani Dhaviza
Prodi Manajemen Informatika
2024

📄 Lisensi

Proyek ini bersifat open-source dan bebas digunakan atau dimodifikasi.
