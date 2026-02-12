# Deployment Guide - Aplikasi Laporan Keuanganku

## Persiapan Server

### Kebutuhan Sistem
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite3
- Web server (Nginx/Apache)

### Instalasi Dependencies
```bash
# Clone repository
git clone <repository-url>
cd laporan-keuanganku

# Install PHP dependencies
composer install --no-dev

# Install Node.js dependencies
npm install
npm run build
```

### Konfigurasi Environment
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database connection in .env
DB_CONNECTION=sqlite
# Pastikan file database/database.sqlite ada dan dapat ditulis
touch database/database.sqlite
```

### Setup Database
```bash
# Jalankan migrasi
php artisan migrate --force

# (Opsional) Jalankan seeding
php artisan db:seed
```

## Konfigurasi Web Server

### Nginx
```
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/laporan-keuanganku/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Backup Script

Buat script backup untuk database SQLite:

```bash
#!/bin/bash
# backup-db.sh

SOURCE_DB="/path/to/laporan-keuanganku/database/database.sqlite"
BACKUP_DIR="/path/to/backups/"
DATE=$(date +%Y%m%d_%H%M%S)

# Buat direktori backup jika belum ada
mkdir -p $BACKUP_DIR

# Backup database
cp $SOURCE_DB $BACKUP_DIR/database_backup_$DATE.sqlite

# Hapus backup lebih dari 7 hari
find $BACKUP_DIR -name "database_backup_*.sqlite" -mtime +7 -delete
```

Jalankan backup harian dengan cron:
```
# Tambahkan ke crontab untuk backup harian pukul 02:00
0 2 * * * /path/to/backup-db.sh
```

## Cron Job untuk Queue Worker (jika menggunakan queues)

Jika aplikasi menggunakan queue, tambahkan ke crontab:
```
* * * * * cd /path/to/laporan-keuanganku && php artisan schedule:run >> /dev/null 2>&1
```

## Perintah-perintah Penting

```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Update dependencies (saat deployment)
composer install --no-dev --optimize-autoloader
```