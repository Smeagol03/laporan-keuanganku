Perencanaan Aplikasi: Laporan Keuanganku
Proyek ini bertujuan untuk membangun aplikasi pencatatan keuangan pribadi yang ringan, modern, dan siap untuk tahap produksi.

1. Stack Teknologi
• Backend: Laravel (Latest)

• Database: SQLite (Relasional dan portabel)

• Frontend Library: Alpine.js (Untuk interaktivitas ringan)

• Styling: Tailwind CSS v4.0 (Engine terbaru)

• Build Tool: Vite

• HTTP Client: Axios

2. Fitur Utama (MVP)
• Autentikasi Pengguna: Registrasi, Login, dan Logout.

• Manajemen Kategori: Tambah, edit, dan hapus kategori keuangan (Pemasukan/Pengeluaran).

• Catatan Transaksi:

  • Input jumlah uang, kategori, tanggal, dan deskripsi.

  • Daftar riwayat transaksi dengan pagination.

• Dashboard Ringkasan:

  • Total Saldo.

  • Total Pemasukan per bulan.

  • Total Pengeluaran per bulan.

• Filter & Laporan: Filter berdasarkan rentang waktu dan kategori.

3. Skema Database (SQLite)
• users: id, name, email, password, timestamps.

• categories: id, user_id, name, type (income/expense), color_code, timestamps.

• transactions: id, user_id, category_id, amount (decimal), description, date, timestamps.

4. Alur Pengembangan
Tahap 1: Inisialisasi & Setup

• Install Laravel & konfigurasi `.env` untuk SQLite.

• Install & integrasi Tailwind CSS 4 + Alpine.js.

• Setup sistem autentikasi (Laravel Breeze atau manual).

Tahap 2: Backend & Logic

• Pembuatan Migration, Model, dan Controller.

• Implementasi CRUD Kategori dan Transaksi.

• Middleware untuk proteksi data per user.

Tahap 3: Frontend (Alpine.js & UI)

• Integrasi Alpine.js untuk modal input transaksi, dropdown, dan reactive state.

• Styling menggunakan Tailwind CSS 4.

• Visualisasi data sederhana (misal: progress bar pengeluaran).

Tahap 4: Persiapan Produksi

• Optimasi: `php artisan optimize`, `npm run build`.

• Keamanan: Validasi input ketat, proteksi SQL Injection (default Laravel).

• Deployment: Setup server (VPS/PaaS), konfigurasi SSL, dan otomatisasi database backup.

5. Target Akhir
Aplikasi yang responsif, cepat diakses, dan memberikan gambaran finansial yang akurat bagi pengguna.