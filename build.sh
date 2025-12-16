#!/bin/bash
set -e

echo "==> Setting up environment..."
cp .env.example .env

# Use Netlify's URL or fallback to APP_URL env var
if [ -n "$URL" ]; then
  echo "APP_URL=$URL" >> .env
elif [ -n "$APP_URL" ]; then
  echo "APP_URL=$APP_URL" >> .env
fi

echo "APP_ENV=production" >> .env
echo "APP_DEBUG=false" >> .env

php artisan key:generate

echo "==> Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "==> Building assets..."
npm run production

echo "==> Generating static site..."
php please ssg:generate

echo "==> Build complete!"
ls -la storage/app/static/ | head -10
