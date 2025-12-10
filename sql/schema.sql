-- Database: perpustakaan
USE library_System;

-- Table: books
CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) DEFAULT NULL,
  isbn VARCHAR(50) DEFAULT NULL,
  year YEAR DEFAULT NULL,
  copies INT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table: students
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  nim VARCHAR(50) UNIQUE,
  department VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table: loans
CREATE TABLE IF NOT EXISTS loans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  book_id INT NOT NULL,
  student_id INT NOT NULL,
  loan_date DATE NOT NULL,
  due_date DATE NOT NULL,
  returned TINYINT(1) NOT NULL DEFAULT 0,
  returned_date DATE DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_loans_book FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE RESTRICT,
  CONSTRAINT fk_loans_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO books (title, author, isbn, year, copies) VALUES
('Pemrograman Web', 'Agus Santoso', '978-001', 2020, 3),
('Basis Data', 'Siti Aminah', '978-002', 2019, 2),
('Algoritma dan Struktur Data', 'Budi Hartono', '978-003', 2021, 4),
('Jaringan Komputer', 'Dwi Purnomo', '978-004', 2018, 5),
('Sistem Operasi', 'Citra Lestari', '978-005', 2020, 2),
('Rekayasa Perangkat Lunak', 'Eko Prasetyo', '978-006', 2022, 3),
('Kecerdasan Buatan', 'Fajar Hidayat', '978-007', 2021, 4),
('Machine Learning Dasar', 'Gita Prawitasari', '978-008', 2022, 3),
('Keamanan Siber', 'Hendra Wijaya', '978-009', 2020, 2),
('Cloud Computing', 'Intan Maharani', '978-010', 2019, 3),
('Pemrograman Python', 'Joko Prabowo', '978-011', 2021, 4),
('Pemrograman JavaScript', 'Kirana Putri', '978-012', 2022, 3),
('Sistem Informasi Manajemen', 'Luthfi Rahman', '978-013', 2018, 2),
('Teknik Kompilasi', 'Maya Sari', '978-014', 2020, 3),
('Arsitektur Komputer', 'Nanda Febriansyah', '978-015', 2019, 4),
('Data Mining', 'Oktavia Widya', '978-016', 2021, 2),
('Statistik untuk Informatika', 'Putra Mahendri', '978-017', 2020, 3),
('Metode Penelitian', 'Qori Aulia', '978-018', 2019, 2),
('Analisis Sistem', 'Rama Setiawan', '978-019', 2021, 3),
('Internet of Things', 'Salsa Anindya', '978-020', 2022, 4);

INSERT INTO students (name, nim, department) VALUES
('Adam Nirvana', '2023001', 'Informatika'),
('Budi Santoso', '2023002', 'Teknik Elektro'),
('Citra Amalia', '2023003', 'Sistem Informasi'),
('Dewi Lestari', '2023004', 'Manajemen Informatika'),
('Eko Prasetyo', '2023005', 'Teknik Komputer'),
('Fajar Hidayat', '2023006', 'Informatika'),
('Gita Ayu Prawiti', '2023007', 'Teknik Elektro'),
('Hendra Wijaya', '2023008', 'Sistem Informasi'),
('Intan Maharani', '2023009', 'Informatika'),
('Joko Prabowo', '2023010', 'Teknik Komputer'),
('Kirana Putri', '2023011', 'Sistem Informasi'),
('Luthfi Rahman', '2023012', 'Informatika'),
('Maya Sari', '2023013', 'Manajemen Informatika'),
('Nanda Febriansyah', '2023014', 'Teknik Elektro'),
('Oktavia Widya', '2023015', 'Sistem Informasi'),
('Putra Mahendri', '2023016', 'Informatika'),
('Qori Aulia', '2023017', 'Teknik Komputer'),
('Rama Setiawan', '2023018', 'Informatika'),
('Salsa Anindya', '2023019', 'Sistem Informasi'),
('Teguh Wicaksono', '2023020', 'Teknik Elektro'),
('Ulfa Zahra', '2023021', 'Manajemen Informatika'),
('Vino Akbar', '2023022', 'Informatika'),
('Wulan Indriani', '2023023', 'Sistem Informasi'),
('Xavier Pratama', '2023024', 'Teknik Komputer'),
('Yeni Anggraini', '2023025', 'Informatika'),
('Zaky Ramadhan', '2023026', 'Sistem Informasi'),
('Alya Nur Safitri', '2023027', 'Informatika'),
('Bagas Prakoso', '2023028', 'Teknik Elektro'),
('Celine Oktaviana', '2023029', 'Sistem Informasi'),
('Dani Firmansyah', '2023030', 'Informatika');


-- Data peminjaman (loan_date = hari ini)
INSERT INTO loans (book_id, student_id, loan_date, due_date) VALUES
(1, 1, '2025-12-05', '2025-12-12'),
(2, 3, '2025-12-05', '2025-12-12'),
(3, 5, '2025-12-05', '2025-12-12'),
(4, 7, '2025-12-05', '2025-12-12'),
(5, 9, '2025-12-05', '2025-12-12'),
(6, 11, '2025-12-05', '2025-12-12'),
(7, 13, '2025-12-05', '2025-12-12'),
(8, 15, '2025-12-05', '2025-12-12'),
(9, 17, '2025-12-05', '2025-12-12'),
(10, 19, '2025-12-05', '2025-12-12'),
(11, 2, '2025-12-05', '2025-12-12'),
(12, 4, '2025-12-05', '2025-12-12'),
(13, 6, '2025-12-05', '2025-12-12'),
(14, 8, '2025-12-05', '2025-12-12'),
(15, 10, '2025-12-05', '2025-12-12');


-- DATA LOANS OVERDUE (untuk test denda)
-- overdue 3–20 hari
INSERT INTO loans (book_id, student_id, loan_date, due_date) VALUES
-- Telat 3 hari
(6, 12, '2025-11-28', '2025-12-07'),

-- Telat 5 hari
(7, 14, '2025-11-26', '2025-12-05'),

-- Telat 7 hari
(8, 16, '2025-11-24', '2025-12-03'),

-- Telat 10 hari
(9, 18, '2025-11-20', '2025-11-30'),

-- Telat 12 hari
(10, 20, '2025-11-18', '2025-11-28'),

-- Telat 15 hari
(11, 1, '2025-11-15', '2025-11-25'),

-- Telat 17 hari
(12, 4, '2025-11-13', '2025-11-23'),

-- Telat 18 hari
(13, 6, '2025-11-12', '2025-11-22'),

-- Telat 19 hari
(14, 9, '2025-11-11', '2025-11-21'),

-- Telat 20 hari
(15, 11, '2025-11-10', '2025-11-20');



