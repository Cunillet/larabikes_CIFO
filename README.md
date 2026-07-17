# Laravel Bikes Project

A learning project to explore Laravel 13.x features, implementing authentication with Fortify, debugging with Telescope, and a complete CRUD system for motorcycle management.

## System Requirements

- **PHP**: 8.4 or higher
- **Composer**: 2.x
- **Node.js**: 20.x or higher (optional, for assets)
- **NPM**: 10.x or higher (optional)
- **Database**: MySQL 8.0 / PostgreSQL 15 / SQLite 3
- **Web Server**: Apache / Nginx / Laravel Valet / Laravel Sail

## Installation

./setup.sh

# Telescope

composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate

# Fortify

composer require laravel/fortify
php artisan fortify:install
php artisan migrate

### 1. Clone the repository

```bash
git clone https://github.com/your-username/laravel-bikes.git
cd laravel-bikes
