#!/bin/bash

# Stop on error
set -e

echo "🚀 Starting deployment script based on README.md..."

# 1. Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

# 2. Install JavaScript dependencies
echo "📦 Installing JavaScript dependencies..."
npm install

# 3. Set up environment
if [ ! -f ".env" ]; then
    echo "⚙️ Setting up environment file..."
    cp .env.example .env
    php artisan key:generate
else
    echo "✅ .env file already exists."
fi

# 4. Build assets
echo "🏗️ Building assets..."
npm run build

echo "✅ Deployment finished successfully!"

# 5. Start the server
echo "🚀 Starting server on PORT 8080..."
php artisan serve --port=8080
