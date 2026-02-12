#!/bin/bash
# production-setup.sh - Script untuk setup aplikasi dalam mode produksi

# Direktori aplikasi
APP_DIR="/home/alpiant/Documents/Websites/laporan-keuanganku"
cd $APP_DIR

echo "Menjalankan setup produksi..."

# Install dependencies tanpa dev
composer install --no-dev --optimize-autoloader

# Build assets
npm install
npm run build

# Generate application key jika belum ada
php artisan key:generate --force

# Cache konfigurasi
php artisan config:cache

# Cache route
php artisan route:cache

# Cache view
php artisan view:cache

# Jalankan migrasi (jika ada migrasi baru)
php artisan migrate --force

echo "Setup produksi selesai!"