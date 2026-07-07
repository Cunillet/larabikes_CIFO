#!/bin/bash

echo "🎯 Creating fresh Laravel project with Xdebug..."
echo "=================================================="

# Check if port 9003 is in use
if lsof -i :9003 > /dev/null 2>&1; then
    echo "⚠️  Port 9003 is in use. Please close the application using it or run:"
    echo "   lsof -i :9003"
    echo "   kill -9 [PID]"
    exit 1
fi

# Create Laravel project
echo "📦 Creating Laravel project..."
docker run --rm -v $(pwd):/app composer create-project laravel/laravel laravel-app

# Check if Laravel was created successfully
if [ ! -d "laravel-app" ]; then
    echo "❌ Failed to create Laravel project"
    exit 1
fi

# Set permissions
echo "🔧 Setting permissions..."
chmod -R 777 laravel-app/storage
chmod -R 777 laravel-app/bootstrap/cache

# Ensure .env file exists
if [ ! -f "laravel-app/.env" ]; then
    echo "⚙️ Creating .env file from example..."
    cp laravel-app/.env.example laravel-app/.env
fi

# Create .env file with database settings
echo "⚙️ Configuring environment..."
cat > laravel-app/.env << 'EOF'
APP_NAME="Larabikes"
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:rlb5u+be9g/e8X4uGibQDB9mGoLvEGjezrablXOaPIo=
APP_URL=http://localhost:8080

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=larabikes
DB_USERNAME=larabikes_admin
DB_PASSWORD=rootpassword

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_UK

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
EOF

# Build and start containers
echo "🐳 Building Docker containers..."
docker compose build --no-cache

echo "🚀 Starting containers..."
docker compose up -d

# Wait for containers to be ready
echo "⏳ Waiting for services to be ready..."
sleep 10

# Run Laravel setup commands
echo "🔑 Generating application key..."
docker compose exec app php artisan key:generate --force

echo "🔗 Creating storage link..."
docker compose exec app php artisan storage:link

echo "📊 Running migrations..."
docker compose exec app php artisan migrate --force

# Create a test route for debugging
echo "🧪 Creating debug test route..."
docker compose exec app bash -c 'cat >> /var/www/html/routes/web.php << "EOF"

// Debug test route - set breakpoints here
Route::get("/debug", function () {
    $testData = [
        "message" => "Xdebug is working!",
        "items" => ["Apple", "Banana", "Cherry"],
        "timestamp" => now()->toDateTimeString()
    ];
    
    $processed = array_map(function($item) {
        return strtoupper($item);  // Set breakpoint here
    }, $testData["items"]);
    
    return response()->json([
        "status" => "success",
        "original" => $testData,
        "processed" => $processed
    ]);
});
EOF'

echo ""
echo "✅ Setup complete!"
echo "=================================================="
echo ""
echo "🌐 Access application:"
echo "   Laravel: http://localhost:8080"
echo "   phpMyAdmin: http://localhost:8081 (user: root, pass: rootpassword)"
echo "   Debug Test: http://localhost:8080/debug"
echo ""
echo "🐘 Xdebug Configuration:"
echo "   Port: 9003"
echo "   IDE Key: VSCODE"
echo ""
echo "🔧 To start debugging:"
echo "   1. In VS Code, open this folder"
echo "   2. Press F5 or go to Run → Start Debugging"
echo "   3. Set a breakpoint in laravel-app/routes/web.php (line with 'strtoupper')"
echo "   4. Visit http://localhost:8080/debug"
echo "   5. VS Code should stop at your breakpoint"
echo ""
echo "📝 Useful commands:"
echo "   docker compose exec app php artisan tinker"
echo "   docker compose logs -f app"
echo "   docker compose down"
echo "   docker compose down -v"
echo "   docker compose up -d"
echo "   docker compose up --build"
echo "   docker compose up --no-cache"
echo "   docker compose exec app php artisan config:cache"
echo "   docker compose exec app php artisan config:clear"
echo "   docker compose exec app php artisan lang:publish"
echo ""
echo "📝 Useful paths:"
echo "   controllers: ./app/Http/Controllers/"
echo "   views:       ./resources/views/"
echo "   models:      ./app/Models/"