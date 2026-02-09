# PHP_Laravel12_Statamic_CMS

## Project Introduction

This project demonstrates how to install and configure Statamic CMS within a Laravel 12 application. Statamic is a modern, hybrid CMS that can use both flat files and a database, built on top of Laravel. It provides:

- A modern control panel for managing content and users

- Flexible content modeling with collections, taxonomies, and globals

- Support for Blade and Antlers templating

- Powerful file-based content storage for structured content

- Easy user, role, and permission management


------------------------------------------------------------------------

## Project Overview

The PHP_Laravel12_Statamic_CMS project demonstrates:

- Laravel 12 Setup – Installing and configuring Laravel as the foundation

- Statamic Installation – Installing Statamic CMS via Composer and running the installer

- Database Integration – Configuring Laravel to use MySQL for storing users, roles, and permissions

- User Management – Creating database-driven users, assigning roles and permissions

- Statamic Backend – Using the control panel (/cp) to manage users, collections, and site data

- Secure Authentication – Handling login, CSRF protection, and disabling WebAuthn for local development

- Folder Structure – Organizing content in content/, configurations in config/statamic/, and views in resources/views/

------------------------------------------------------------------------

##  System Requirements

Make sure your system has:

-   PHP **8.2+**
-   Composer **latest**
-   Node.js **18+**
-   MySQL / SQLite (optional for Statamic)
-   Laravel CLI installed


------------------------------------------------------------------------

## Step 1: Create Laravel 12 Project

Run:

``` bash
composer create-project laravel/laravel PHP_Laravel12_Statamic_CMS "12.*"
cd PHP_Laravel12_Statamic_CMS
```

------------------------------------------------------------------------

## Step 2: Install Statamic CMS

Statamic provides an official installer.

``` bash
composer require statamic/statamic
```

Publish files & install:

``` bash
php artisan statamic:install
```

------------------------------------------------------------------------

## Step 3: configure .env

```.env
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_statamic_cms
DB_USERNAME=root
DB_PASSWORD=

SESSION_DOMAIN=localhost
```

------------------------------------------------------------------------

## Step 4: migration file

### Create ONE new migration

Run:

```bash
php artisan make:migration add_statamic_fields_to_users_table
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('super')->default(false)->after('password');
            $table->timestamp('last_login')->nullable()->after('super');
            $table->json('roles')->nullable()->after('last_login');
            $table->json('permissions')->nullable()->after('roles');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['super', 'last_login', 'roles', 'permissions']);
        });
    }
};
```

###  Create roles + pivot tables migration

Run this:

```bash
php artisan make:migration create_statamic_roles_tables
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        // Pivot: role_user
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('role_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // Groups table (Statamic may expect)
        Schema::create('groups', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->timestamps();
        });

        // Pivot: group_user
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('group_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
```

### Run migration

```bash
php artisan migrate
```

### Clear cache (must)

```bash
php artisan optimize:clear
```

------------------------------------------------------------------------

## Step 5: Disable WebAuthn (local only)

Open config file

```
config/statamic/users.php
```

Change:

```
'webauthn' => 'webauthn',
```

to:

```
'webauthn' => false,
```

Then:

```bash
php artisan optimize:clear
```

------------------------------------------------------------------------

## Step 6: Create Statamic Admin User

```bash
php artisan statamic:make:user
```

Enter:

Name:

Email:

Password:

Super Admin = yes


------------------------------------------------------------------------

## Step 7: Start Development Server

```bash
php artisan serve 
```
Open:

```bash
http://localhost:8000/cp
```

------------------------------------------------------------------------

## Output

### Dashboard

<img width="1919" height="1030" alt="Screenshot 2026-02-09 115950" src="https://github.com/user-attachments/assets/1e78973a-244b-4e78-9be3-830935e5e766" />

------------------------------------------------------------------------

## Project Folder Structure 

```
PHP_Laravel12_Statamic_CMS
│
├── app/
├── bootstrap/
├── config/
│   └── statamic/
├── content/
│   ├── collections/
│   ├── globals/
│   ├── navigation/
│   ├── taxonomies/
│   ├── assets/
├── database/
├── public/
├── resources/
│   └── views/
│   ├── users/
├── routes/
├── storage/
├── vendor/
└── .env
```

### Key Statamic Folders

#### content/

Contains:

    collections/
    taxonomies/
    navigation/
    globals/
    assets/

These store **pages, blog posts, menus, site data**.

#### resources/views/

Used for:

-   Blade templates
-   Antlers templates

#### routes/web.php

Handles custom Laravel routes alongside Statamic.

------------------------------------------------------------------------

Your PHP_Laravel12_Statamic_CMS Project is now ready!
