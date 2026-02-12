# Dokumentasi Aplikasi Laporan Keuanganku

## Struktur Database

### Tabel `users`
| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT UNSIGNED | Primary key, auto increment |
| name | VARCHAR(255) | Nama lengkap pengguna |
| email | VARCHAR(255) | Alamat email (unik) |
| password | VARCHAR(255) | Hash password |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu pembaruan |

### Tabel `categories`
| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT UNSIGNED | Primary key, auto increment |
| user_id | BIGINT UNSIGNED | Foreign key ke tabel users |
| name | VARCHAR(255) | Nama kategori |
| type | ENUM('income', 'expense') | Tipe kategori |
| color | VARCHAR(7) | Kode warna HEX |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu pembaruan |

### Tabel `transactions`
| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | BIGINT UNSIGNED | Primary key, auto increment |
| user_id | BIGINT UNSIGNED | Foreign key ke tabel users |
| category_id | BIGINT UNSIGNED | Foreign key ke tabel categories |
| amount | DECIMAL(15, 2) | Jumlah uang |
| description | TEXT | Deskripsi transaksi (opsional) |
| transaction_date | DATE | Tanggal transaksi |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu pembaruan |

## API Endpoints

### Otentikasi
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman registrasi
- `POST /register` - Proses registrasi
- `POST /logout` - Proses logout

### Dashboard
- `GET /dashboard` - Halaman dashboard

### Kategori
- `GET /categories` - Menampilkan daftar kategori
- `GET /categories/create` - Halaman pembuatan kategori
- `POST /categories` - Membuat kategori baru
- `GET /categories/{id}/edit` - Halaman edit kategori
- `PUT/PATCH /categories/{id}` - Memperbarui kategori
- `DELETE /categories/{id}` - Menghapus kategori

### Transaksi
- `GET /transactions` - Menampilkan daftar transaksi
- `GET /transactions/create` - Halaman pembuatan transaksi
- `POST /transactions` - Membuat transaksi baru
- `GET /transactions/{id}/edit` - Halaman edit transaksi
- `PUT/PATCH /transactions/{id}` - Memperbarui transaksi
- `DELETE /transactions/{id}` - Menghapus transaksi

## Fungsi Utama

### DashboardController
- `index()` - Menampilkan ringkasan keuangan termasuk total saldo, pemasukan bulanan, dan pengeluaran bulanan

### CategoryController
- `index()` - Menampilkan daftar kategori milik pengguna
- `create()` - Menampilkan form pembuatan kategori
- `store()` - Menyimpan kategori baru
- `edit()` - Menampilkan form edit kategori
- `update()` - Memperbarui kategori
- `destroy()` - Menghapus kategori

### TransactionController
- `index()` - Menampilkan daftar transaksi milik pengguna
- `create()` - Menampilkan form pembuatan transaksi
- `store()` - Menyimpan transaksi baru
- `edit()` - Menampilkan form edit transaksi
- `update()` - Memperbarui transaksi
- `destroy()` - Menghapus transaksi

## Otorisasi
- Semua endpoint kecuali otentikasi memerlukan login
- Pengguna hanya dapat mengakses data miliknya sendiri berkat policy yang telah dibuat
- Policy untuk Category dan Transaction memastikan pengguna hanya bisa mengelola miliknya sendiri

## Testing
- Unit test untuk memastikan logika perhitungan berjalan dengan benar
- Feature test untuk memastikan alur otentikasi dan CRUD berjalan dengan baik