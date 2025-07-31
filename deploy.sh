#!/bin/bash

# Laravel Forge Deployment Script
# This script handles the deployment process for the ROOTS application

echo "Starting deployment..."

# Navigate to the project directory
cd /home/forge/default

# Pull the latest changes
git pull origin main

# Install/update Composer dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache configuration
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Clear application cache
php artisan cache:clear

# Optimize the application
php artisan optimize

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R forge:forge storage bootstrap/cache

echo "Deployment completed successfully!" 