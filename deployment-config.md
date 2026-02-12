# Deployment Configuration for Laravel Forge / Ploi

## Server Requirements
- Ubuntu 20.04+ or CentOS 8+
- PHP 8.2+
- Composer
- Node.js 16+
- Nginx
- SQLite

## Deployment Steps
1. Clone repository to `/home/forge/domain.com`
2. Run `composer install --no-dev`
3. Run `npm install && npm run build`
4. Create `.env` file with production settings
5. Run `php artisan key:generate`
6. Run `php artisan migrate --force`
7. Set directory ownership: `chown -R forge:forge /home/forge/domain.com`
8. Configure Nginx site
9. Restart PHP-FPM and Nginx

## Environment Variables for Production
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

## Cron Jobs
# Laravel Scheduler
* * * * * cd /home/forge/domain.com && php artisan schedule:run >> /dev/null 2>&1

# Queue Worker (if using queues)
# * * * * * cd /home/forge/domain.com && php artisan queue:work --daemon >> /dev/null 2>&1

## Post-deployment Commands
chmod -R 755 /home/forge/domain.com/storage
chmod -R 755 /home/forge/domain.com/bootstrap/cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache