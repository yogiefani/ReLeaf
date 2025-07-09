#!/usr/bin/env bash
# Exit on error
set -o errexit

echo "--- Starting Build Process ---"

# 1. Install PHP dependencies
echo "Installing Composer dependencies..."
composer install --no-dev --no-progress --prefer-dist

# 2. Install Node.js dependencies
echo "Installing NPM dependencies..."
npm install

# 3. Build frontend assets with Vite/Tailwind
echo "Building frontend assets..."
npm run build

# 4. Clear and cache Laravel configuration for production
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "--- Build Finished Successfully ---"