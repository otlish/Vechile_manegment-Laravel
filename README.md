# 🚗 Vehicle Management System

A full-stack vehicle rental management system built with **Laravel** and **Bootstrap 5**. This application enables customers to browse vehicles, book rentals with online payment via **eSewa**, and allows administrators to manage the entire fleet and booking lifecycle.

---

## ✨ Features

### Customer Features
- 🔐 Secure registration & login with role-based access
- 🚘 Browse available vehicles with detailed specs and images
- 📅 Book vehicles with date selection and automatic price calculation
- 💳 Online payment via **eSewa Payment Gateway**
- 📋 View active rentals and rental history
- 👤 Profile management

### Admin Features
- 📊 Dashboard with key metrics (total vehicles, active rentals, customers)
- 🚗 Full CRUD for vehicle management (add, edit, delete with images)
- ✅ Approve or reject booking requests
- 🔄 Mark vehicles as returned
- 👥 Customer management
- 📜 View returned rental history

---

## 🛠️ Tech Stack

| Layer      | Technology                     |
|------------|--------------------------------|
| Backend    | Laravel 11 (PHP)               |
| Frontend   | Blade Templates, Bootstrap 5   |
| Database   | MySQL                          |
| Payment    | eSewa Payment Gateway          |
| Auth       | Laravel Breeze                 |
| Font       | Google Fonts (Outfit)          |

---

## 📋 Prerequisites

- **PHP** >= 8.2
- **Composer**
- **MySQL** (XAMPP, WAMP, or standalone)
- **Node.js & NPM** (for frontend assets)
- **Git**

---

## 🚀 Installation & Setup

### 1. Clone the repository
```bash
git clone https://github.com/otlish/Vechile_manegment-Laravel.git
cd Vechile_manegment-Laravel
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure the database
Open `.env` and update the database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vechile_management
DB_USERNAME=root
DB_PASSWORD=
```

> **Note:** Create the `vechile_management` database in MySQL before proceeding.

### 5. Run migrations & seed data
```bash
php artisan migrate
php artisan db:seed
```

This will create:
- **Admin user** — `admin@gmail.com` / `admin123`
- **5 sample vehicles** with images

### 6. Link storage
```bash
php artisan storage:link
```

### 7. Start the development server
```bash
php artisan serve
```

Visit: **http://127.0.0.1:8000**

---

## 🔑 Default Login Credentials

| Role     | Email              | Password   |
|----------|--------------------|------------|
| Admin    | admin@gmail.com    | admin123   |

> Customers can register through the registration page.

---

## 💳 eSewa Payment (Test Mode)

The application uses eSewa's **test environment** for payment processing.

| Config              | Value                                                    |
|---------------------|----------------------------------------------------------|
| Merchant ID         | `EPAYTEST`                                               |
| Test Environment    | `https://rc-epay.esewa.com.np`                           |

**Test Credentials:**
- Use any eSewa test account
- OTP: `123456`

---

## 📁 Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php        # Admin dashboard & rental management
│   │   │   ├── AdminVehicleController.php  # Vehicle CRUD operations
│   │   │   ├── BookingController.php       # Booking & eSewa payment initiation
│   │   │   ├── CustomerController.php      # Customer dashboard & browsing
│   │   │   └── EsewaController.php         # eSewa payment callbacks
│   │   └── Middleware/
│   │       └── RoleMiddleware.php          # Role-based access control
│   └── Models/
│       ├── Booking.php
│       ├── User.php
│       └── Vehicle.php
├── database/
│   ├── migrations/                         # Database schema
│   └── seeders/                            # Admin user & sample vehicles
├── resources/views/
│   ├── admin/                              # Admin panel views
│   ├── bookings/                           # Booking form
│   ├── customer/                           # Customer views
│   ├── layouts/                            # Layout templates
│   ├── dashboard.blade.php                 # Customer dashboard
│   ├── welcome.blade.php                   # Landing page
│   └── esewa_payment.blade.php             # eSewa redirect form
└── routes/
    └── web.php                             # Application routes
```

---

## 🔄 Booking Workflow

```
Customer browses vehicles
        ↓
Selects dates & confirms booking
        ↓
Redirected to eSewa for payment
        ↓
Payment completed → Booking status: "Pending"
        ↓
Admin approves → Booking status: "Active"
        ↓
Vehicle returned → Booking status: "Completed"
```

---

## 👥 Contributors

- **[otlish](https://github.com/otlish)**

---

## 📄 License

This project is developed as part of an academic internship program.
