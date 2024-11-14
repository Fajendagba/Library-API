# Book Library API

## Overview
This Book Library API is built using Laravel, it's a small application in Laravel that manages a simple API for a book library. The system includes endpoints for book creation, updating, deletion, and listing, all protected by Laravel Sanctum for secure access.

## Features
- User Registration and Authentication
- Book Library: Create, Update, Delete, List, and View Books with pagination
- Error handling
- Validation
- Rate limiting
- search (by isbn, author, and title) and filter (by author and status)
- Soft delete

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/Fajendagba/Library-API.git
    cd library-api
    ```

2. **Install dependencies:**
    ```sh
    composer install
    ```

3. **Create a `.env` file:**
    ```sh
    cp .env.example .env
    ```

4. **Generate application key:**
    ```sh
    php artisan key:generate
    ```

5. **Set up your database credentials in the `.env` file:**
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. **Run database migrations:**
    ```sh
    php artisan migrate
    ```

7. **Start the development server:**
    ```sh
    php artisan serve
    ```
