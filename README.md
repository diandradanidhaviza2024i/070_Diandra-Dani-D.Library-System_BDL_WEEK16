# 📚 Library System --- Sistem Perpustakaan Kampus

Aplikasi Web **PHP + MySQL**\
Program Studi **Manajemen Informatika**

------------------------------------------------------------------------

## 📝 Deskripsi Singkat

**Library System** adalah aplikasi web berbasis PHP, MySQL/MariaDB, dan
JavaScript yang dirancang untuk mengelola proses administrasi
perpustakaan kampus.\
Sistem ini dibuat sebagai proyek mata kuliah **Basis Data Lanjut (BDL)**
untuk prodi **Manajemen Informatika** dan mencakup fitur lengkap seperti
manajemen buku, manajemen mahasiswa, serta sistem peminjaman dan
pengembalian buku.

Aplikasi ini bertujuan membantu perpustakaan kampus mengelola data
secara lebih efektif dan cepat dengan tampilan antarmuka yang mudah
digunakan.

------------------------------------------------------------------------

## ✨ Fitur-Fitur Utama

### 📌 1. Manajemen Mahasiswa (CRUD)

-   Tambah mahasiswa\
-   Edit data mahasiswa\
-   Hapus mahasiswa\
-   Lihat daftar mahasiswa\
-   Pencarian mahasiswa berdasarkan **NIM / nama**

### 📌 2. Manajemen Buku (CRUD)

-   Tambah buku baru\
-   Edit data buku\
-   Hapus buku\
-   Lihat daftar buku\
-   Pencarian buku berdasarkan **judul / kategori / penulis**

### 📌 3. Sistem Peminjaman Buku

-   Meminjam buku (stok berkurang otomatis)\
-   Mengembalikan buku (stok bertambah otomatis)\
-   Validasi ketersediaan buku\
-   Riwayat peminjaman lengkap\
-   Status peminjaman (**dipinjam / dikembalikan**)

### 📌 4. Fitur Database Lanjut

-   **View** → menampilkan data peminjaman lengkap\
-   **Stored Procedure** → proses pinjam & kembali\
-   **Function** → cek stok buku\
-   **Trigger** → update stok otomatis saat pinjam/kembali

### 📌 5. Tampilan Web Modern

-   Desain sederhana & mudah dipahami\
-   Navigasi cepat (Mahasiswa, Buku, Peminjaman)\
-   **Dark Mode & Light Mode**\
-   Responsif untuk laptop & mobile

------------------------------------------------------------------------

## 🗂️ Struktur Proyek

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

------------------------------------------------------------------------

## 🔧 Teknologi yang Digunakan

  Teknologi                  Fungsi
  -------------------------- ------------------------------------
  **PHP 7+**                 Back-end & CRUD
  **MySQL / MariaDB**        Sistem database
  **HTML5 + CSS3**           Struktur & tampilan
  **JavaScript**             Interaksi UI
  **Bootstrap (opsional)**   Responsif & styling
  **SQL Advanced**           View, Procedure, Function, Trigger

------------------------------------------------------------------------

## 🚀 Cara Menjalankan

1.  Install **XAMPP / Laragon / MAMP**\

2.  Tempatkan project ke folder:

        htdocs/library-system

3.  Buat database:

    ``` sql
    CREATE DATABASE library_db;
    ```

4.  Import file SQL pada folder `/sql/`\

5.  Sesuaikan konfigurasi pada:

        config/db.php

6.  Jalankan di browser:

        http://localhost/library-system

------------------------------------------------------------------------

## 🎓 Tujuan Pembuatan Project

-   Memenuhi tugas praktik mata kuliah **Basis Data Lanjut**\
-   Latihan membuat aplikasi web dengan CRUD lengkap\
-   Menerapkan fitur **View, Procedure, Function, Trigger**\
-   Menjadi contoh aplikasi sistem perpustakaan kampus

------------------------------------------------------------------------

## 👨‍💻 Pembuat

**Diandra Dani Dhaviza**\
Prodi **Manajemen Informatika**\
2024

------------------------------------------------------------------------

## 📄 Lisensi

Proyek ini bersifat **open‑source** dan bebas dimodifikasi.
