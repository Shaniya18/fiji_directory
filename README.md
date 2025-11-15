
# Fiji Web Directory

A modern Fiji-based business directory built with **Laravel**, allowing users to browse categories, view listings, submit businesses, and leave reviews. Includes a secure **admin panel** for managing listings, categories, users, reviews, and submissions.

## Features

* Browse business listings by category
* Search and view detailed listings
* User signup & login
* Submit new business listings
* Write and view reviews
* Contact businesses
* Admin dashboard for approvals and management

## Tech Stack

* Laravel (Backend & MVC)
* Blade Templates (Frontend)
* MySQL Database
* Vite + JavaScript
* Custom CSS

## Installation

```bash
git clone https://github.com/Shaniya18/fiji_directory.git
cd fiji_directory/fiji-web-directory
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
```

## Default Admin Login

```
Email: admin@example.com
Password: password
```

