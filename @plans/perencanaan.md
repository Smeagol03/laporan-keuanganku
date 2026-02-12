# **Perencanaan Proyek: Aplikasi Laporan Keuanganku**

## **1. Tujuan Proyek**

Membangun sebuah aplikasi web untuk pencatatan keuangan pribadi yang modern, ringan, aman, dan _production-ready_. Aplikasi ini bertujuan untuk memberikan pengguna kemudahan dalam mengelola dan memvisualisasikan pemasukan serta pengeluaran mereka dengan antarmuka yang intuitif dan responsif.

## **2. Stack Teknologi**

| Kategori          | Teknologi             | Versi/Spesifikasi                   | Keterangan                                    |
| ----------------- | --------------------- | ----------------------------------- | --------------------------------------------- |
| **Backend**       | Laravel               | Versi 11+ (Terbaru)                 | Framework utama untuk membangun logika aplikasi |
| **Database**      | SQLite                |                                     | Sistem database relasional, portabel & ringan |
| **Frontend**      | Alpine.js             | v3                                  | Library JavaScript untuk interaktivitas       |
| **Styling**       | Tailwind CSS          | v4.0 (Lightning JIT Engine)         | Utilitas CSS untuk membangun UI kustom        |
| **Build Tool**    | Vite                  |                                     | Bundler aset frontend modern dan cepat        |
| **HTTP Client**   | Axios                 |                                     | Untuk permintaan AJAX (jika diperlukan)       |
| **Testing**       | Pest                  |                                     | Framework testing PHP yang elegan             |

## **3. Fitur Utama (Minimum Viable Product - MVP)**

### **3.1. Autentikasi Pengguna**
-   Registrasi pengguna baru (Nama, Email, Password).
-   Login dengan kredensial yang aman.
-   Logout dari sesi aktif.
-   Proteksi halaman yang memerlukan login.

### **3.2. Manajemen Kategori**
-   **CRUD (Create, Read, Update, Delete)** untuk kategori.
-   Setiap kategori memiliki:
    -   Nama (misal: "Gaji", "Makanan", "Transportasi").
    -   Tipe (`income` atau `expense`).
    -   Kode warna (HEX) untuk identifikasi visual di UI.
-   Setiap pengguna hanya dapat mengelola kategorinya sendiri.

### **3.3. Pencatatan Transaksi**
-   **CRUD (Create, Read, Update, Delete)** untuk transaksi.
-   Setiap transaksi memiliki:
    -   Jumlah uang.
    -   Relasi ke sebuah kategori.
    -   Tanggal transaksi.
    -   Deskripsi singkat (opsional).
-   Menampilkan riwayat transaksi dalam daftar dengan pagination (misal: 15 transaksi per halaman).
-   Setiap pengguna hanya dapat mengelola transaksinya sendiri.

### **3.4. Dashboard & Ringkasan**
-   **Saldo Total:** Kalkulasi dari `(Total Pemasukan - Total Pengeluaran)`.
-   **Ringkasan Bulanan:**
    -   Total Pemasukan pada bulan berjalan.
    -   Total Pengeluaran pada bulan berjalan.
-   Visualisasi sederhana (misal: progress bar) perbandingan pemasukan dan pengeluaran.

### **3.5. Laporan & Filter**
-   Filter riwayat transaksi berdasarkan rentang tanggal (dari tanggal A ke tanggal B).
-   Filter riwayat transaksi berdasarkan satu atau lebih kategori.

## **4. Skema dan Struktur Database**

### **Tabel: `users`**
Menyimpan data pengguna aplikasi.
| Nama Kolom    | Tipe Data         | Atribut/Constraint            | Keterangan              |
| ------------- | ----------------- | ----------------------------- | ----------------------- |
| `id`          | `BIGINT`          | `UNSIGNED`, `PRIMARY KEY`, `AI` | ID unik pengguna        |
| `name`        | `VARCHAR(255)`    |                               | Nama lengkap pengguna   |
| `email`       | `VARCHAR(255)`    | `UNIQUE`                      | Alamat email untuk login|
| `password`    | `VARCHAR(255)`    |                               | Hash password pengguna  |
| `created_at`  | `TIMESTAMP`       | `NULLABLE`                    | Waktu pembuatan rekor   |
| `updated_at`  | `TIMESTAMP`       | `NULLABLE`                    | Waktu pembaruan rekor   |

### **Tabel: `categories`**
Menyimpan kategori pemasukan dan pengeluaran yang dibuat oleh pengguna.
| Nama Kolom    | Tipe Data         | Atribut/Constraint                | Keterangan                          |
| ------------- | ----------------- | --------------------------------- | ----------------------------------- |
| `id`          | `BIGINT`          | `UNSIGNED`, `PRIMARY KEY`, `AI`   | ID unik kategori                    |
| `user_id`     | `BIGINT`          | `UNSIGNED`, `FOREIGN KEY (users.id)` | Relasi ke pemilik kategori          |
| `name`        | `VARCHAR(255)`    |                                   | Nama kategori                       |
| `type`        | `ENUM('income', 'expense')` |                               | Tipe kategori: pemasukan atau pengeluaran |
| `color`       | `VARCHAR(7)`      | `DEFAULT '#FFFFFF'`               | Kode warna HEX (misal: `#34D399`)   |
| `created_at`  | `TIMESTAMP`       | `NULLABLE`                        | Waktu pembuatan rekor               |
| `updated_at`  | `TIMESTAMP`       | `NULLABLE`                        | Waktu pembaruan rekor               |

### **Tabel: `transactions`**
Menyimpan setiap catatan transaksi keuangan pengguna.
| Nama Kolom      | Tipe Data         | Atribut/Constraint                 | Keterangan                          |
| --------------- | ----------------- | ---------------------------------- | ----------------------------------- |
| `id`            | `BIGINT`          | `UNSIGNED`, `PRIMARY KEY`, `AI`    | ID unik transaksi                   |
| `user_id`       | `BIGINT`          | `UNSIGNED`, `FOREIGN KEY (users.id)` | Relasi ke pemilik transaksi         |
| `category_id`   | `BIGINT`          | `UNSIGNED`, `FOREIGN KEY (categories.id)` | Relasi ke kategori transaksi        |
| `amount`        | `DECIMAL(15, 2)`  |                                    | Jumlah uang dalam transaksi         |
| `description`   | `TEXT`            | `NULLABLE`                         | Deskripsi atau catatan singkat      |
| `transaction_date`| `DATE`          |                                    | Tanggal terjadinya transaksi        |
| `created_at`    | `TIMESTAMP`       | `NULLABLE`                         | Waktu pembuatan rekor               |
| `updated_at`    | `TIMESTAMP`       | `NULLABLE`                         | Waktu pembaruan rekor               |

## **5. Rencana & Tahapan Pengembangan**

### **Tahap 1: Inisialisasi dan Fondasi**
1.  **Setup Proyek:**
    -   `laravel new laporan-keuanganku`
    -   Inisialisasi repositori Git.
    -   Konfigurasi file `.env` untuk menggunakan database SQLite dan membuat file `database/database.sqlite`.
2.  **Instalasi Dependensi:**
    -   Install Laravel Breeze untuk autentikasi: `composer require laravel/breeze --dev`.
    -   Jalankan `php artisan breeze:install` dengan stack Blade & Alpine.js.
    -   Install Tailwind CSS v4: `npm install tailwindcss@next @tailwindcss/forms @tailwindcss/typography`.
    -   Konfigurasi `tailwind.config.js` dan `vite.config.js`.
3.  **Migrasi Awal:**
    -   Jalankan `php artisan migrate` untuk membuat tabel `users` dan tabel bawaan lainnya.

### **Tahap 2: Backend - Logika Inti**
1.  **Pembuatan Modul Kategori:**
    -   Buat Model, Migration, Factory, dan Seeder untuk `Category`.
    -   `php artisan make:model Category -mfsc` (Model, Factory, Seeder, Controller).
    -   Definisikan relasi `User` ke `Category` (One-to-Many).
    -   Buat _resourceful routes_ untuk `CategoryController`.
    -   Implementasikan `CategoryPolicy` untuk otorisasi (memastikan user hanya bisa mengelola kategorinya).
2.  **Pembuatan Modul Transaksi:**
    -   Buat Model, Migration, Factory, dan Seeder untuk `Transaction`.
    -   `php artisan make:model Transaction -mfsc`.
    -   Definisikan relasi `User` ke `Transaction` dan `Category` ke `Transaction`.
    -   Buat _resourceful routes_ untuk `TransactionController`.
    -   Implementasikan `TransactionPolicy` untuk otorisasi.
3.  **Logika Dashboard:**
    -   Buat `DashboardController`.
    -   Implementasikan query Eloquent untuk menghitung `Total Saldo`, `Pemasukan Bulan Ini`, dan `Pengeluaran Bulan Ini`.
    -   Data ini akan dilewatkan ke view dashboard.

### **Tahap 3: Frontend - Antarmuka Pengguna**
1.  **Layout Utama:**
    -   Buat layout aplikasi utama (`app.blade.php`) yang mencakup navigasi, header, dan konten utama.
2.  **Halaman Kategori:**
    -   Desain UI untuk menampilkan daftar kategori.
    -   Gunakan Alpine.js untuk menampilkan modal/form _create_ dan _edit_ kategori tanpa perlu me-refresh halaman.
3.  **Halaman Transaksi:**
    -   Desain UI untuk menampilkan daftar transaksi dengan pagination.
    -   Buat form input transaksi, kemungkinan dalam sebuah modal.
    -   Gunakan Alpine.js untuk interaktivitas seperti dropdown kategori dan date picker.
4.  **Halaman Dashboard:**
    -   Visualisasikan data ringkasan yang diterima dari `DashboardController`.
    -   Tampilkan saldo, total bulanan, dan grafik sederhana.
5.  **Styling:**
    -   Terapkan styling konsisten di seluruh aplikasi menggunakan Tailwind CSS.

### **Tahap 4: Testing & Finalisasi**
1.  **Feature Tests (Pest):**
    -   Buat tes untuk memastikan alur autentikasi berfungsi.
    -   Buat tes untuk semua operasi CRUD pada Kategori dan Transaksi.
    -   Pastikan otorisasi (Policies) berjalan sesuai harapan.
2.  **Unit Tests (Pest):**
    -   Jika ada kalkulasi kompleks, buat unit test terpisah untuk memastikan akurasinya.
3.  **Pembersihan & Optimasi:**
    -   Jalankan `vendor/bin/pint` untuk format kode.
    -   Jalankan `php artisan optimize` dan `npm run build` untuk persiapan produksi.

### **Tahap 5: Deployment**
1.  **Persiapan Server:**
    -   Siapkan server (VPS atau PaaS seperti Laravel Forge/Ploi).
    -   Konfigurasi web server (Nginx), PHP, dan Composer.
    -   Setup SSL/TLS (Let's Encrypt).
2.  **Deployment:**
    -   Unggah kode ke server.
    -   Jalankan `composer install --no-dev`, `npm install`, `npm run build`.
    -   Jalankan migrasi database di server.
3.  **Automasi:**
    -   Setup cron job untuk backup database SQLite secara berkala.
