📌 Project Overview

This is a RESTful API built with Laravel 12 for managing users, projects, and timesheets. It includes a flexible Entity-Attribute-Value (EAV) system for dynamic project attributes and uses Laravel Passport for authentication.

🚀 Features

✅ User Authentication (Register, Login, Logout)
✅ CRUD Operations for Users, Projects, Timesheets
✅ Entity-Attribute-Value (EAV) System for Dynamic Project Attributes
✅ Flexible Filtering on Projects (Regular & Dynamic Attributes)
✅ Protected API Routes with Laravel Passport
✅ Structured Database with Migrations & Seeders

🛠️ Installation & Setup

1️⃣ Clone the Repository

git clone https://github.com/anasshahrouri1/astudio
cd astudio

2️⃣ Install Dependencies

composer install

3️⃣ Configure Environment

Copy the .env.example file and rename it to .env, then update the database credentials:

cp .env.example .env

Modify the database settings inside .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_db
DB_USERNAME=root
DB_PASSWORD=yourpassword

4️⃣ Run Database Migrations & Seeders

php artisan migrate --seed

5️⃣ Install & Configure Laravel Passport

php artisan passport:install

6️⃣ Start the Server

php artisan serve

Your API will be running at: http://127.0.0.1:8000/api