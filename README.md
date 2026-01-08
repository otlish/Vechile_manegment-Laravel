# Vehicle Management System

## Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Vechile_manegment-Laravel
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   Create an empty file for the SQLite database:
   - On Windows:
     ```powershell
     New-Item database/database.sqlite
     ```
   - On Mac/Linux:
     ```bash
     touch database/database.sqlite
     ```

   Run migrations:
   ```bash
   php artisan migrate
   ```

6. **Run the Application**
   ```bash
   php artisan serve
   ```
   Access the site at http://localhost:8000
