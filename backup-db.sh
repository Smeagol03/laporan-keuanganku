#!/bin/bash
# backup-db.sh - Script untuk backup database SQLite

# Direktori aplikasi
APP_DIR="/home/alpiant/Documents/Websites/laporan-keuanganku"
SOURCE_DB="$APP_DIR/database/database.sqlite"
BACKUP_DIR="$APP_DIR/storage/backups"
DATE=$(date +%Y%m%d_%H%M%S)

# Buat direktori backup jika belum ada
mkdir -p $BACKUP_DIR

# Backup database
cp $SOURCE_DB $BACKUP_DIR/database_backup_$DATE.sqlite

# Hapus backup lebih dari 7 hari
find $BACKUP_DIR -name "database_backup_*.sqlite" -mtime +7 -delete

echo "Backup database selesai: $BACKUP_DIR/database_backup_$DATE.sqlite"