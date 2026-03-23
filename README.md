# 🚀 Laravel 13 Starter Stack

Setup lengkap **Laravel 13** dengan **Livewire 4**, **Tailwind CSS 4**, **Spatie Laravel Permission 7**, dan **Bootstrap Icons**.

---

## 📦 Tech Stack

| Package                   | Versi  |
| ------------------------- | ------ |
| PHP                       | ^8.3   |
| Laravel Framework         | ^13.0  |
| Livewire                  | ^4.2   |
| Tailwind CSS              | ^4.2.0 |
| Spatie Laravel Permission | ^7.2   |
| Bootstrap Icons           | latest |

---

## ⚙️ Prasyarat

Pastikan sudah terinstal di sistem kamu:

- PHP >= 8.3
- Composer
- Node.js >= 18 & NPM
- Database (MySQL / PostgreSQL / SQLite)

---

## 🛠️ Langkah Setup

### 1. Clone / Buat Project

**Jika clone dari repositori:**

```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

**Jika buat project baru:**

```bash
composer create-project laravel/laravel nama-project
cd nama-project
```

---

### 2. Install Semua Dependency (Otomatis)

Project ini sudah dilengkapi script `setup` di `composer.json`. Cukup jalankan satu perintah:

```bash
composer run setup
```

Perintah ini secara otomatis akan:

1. `composer install` — install semua PHP dependency
2. Salin `.env.example` → `.env` (jika belum ada)
3. Generate `APP_KEY`
4. Jalankan `php artisan migrate`
5. `npm install` — install semua Node dependency
6. `npm run build` — build asset untuk production

> **Catatan:** Jika setup manual, ikuti langkah 3–10 di bawah.

---

### 3. Konfigurasi `.env` (Setup Manual)

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai konfigurasi database kamu:

```env
APP_NAME="Nama Aplikasi"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

> **Untuk SQLite** (default project baru), cukup:
>
> ```env
> DB_CONNECTION=sqlite
> ```
>
> File `database/database.sqlite` sudah dibuat otomatis saat `composer create-project`.

---

### 4. Install PHP Dependency

```bash
composer install
```

---

### 5. Install Livewire 4

Sudah tercantum di `composer.json`. Pastikan sudah ter-install via `composer install`.

Tambahkan directive Livewire ke layout utama (`resources/views/components/layouts/app.blade.php`):

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
```

> Di Livewire 4, `@livewireStyles` dan `@livewireScripts` **tidak lagi diperlukan** — sudah diinjeksi otomatis via Vite.

---

### 6. Install Tailwind CSS 4

```bash
npm install tailwindcss @tailwindcss/vite
```

Konfigurasi Vite (`vite.config.js`):

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

Import Tailwind di `resources/css/app.css`:

```css
@import "tailwindcss";
```

> **Tailwind v4 tidak lagi membutuhkan** file `tailwind.config.js` — konfigurasi dilakukan langsung di CSS menggunakan `@theme`.

---

### 7. Install Bootstrap Icons

```bash
npm install bootstrap-icons
```

Import di `resources/css/app.css`:

```css
@import "tailwindcss";
@import "bootstrap-icons/font/bootstrap-icons.css";
```

Contoh penggunaan di Blade:

```html
<i class="bi bi-house-fill text-blue-500 text-2xl"></i>
<i class="bi bi-person-circle"></i>
<i class="bi bi-shield-lock"></i>
```

---

### 8. Setup Spatie Laravel Permission 7

Sudah tercantum di `composer.json`. Publikasikan konfigurasi dan migration:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

---

### 9. Setup Model User

Tambahkan trait `HasRoles` ke model `User` (`app/Models/User.php`):

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // ...
}
```

---

### 10. Jalankan Migration

```bash
php artisan migrate
```

---

### 11. (Opsional) Seed Role & Permission

Buat seeder di `database/seeders/RolePermissionSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permission
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view dashboard']);

        // Buat role dan assign permission
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('view dashboard');

        // Assign role ke user pertama (opsional)
        User::first()?->assignRole('admin');
    }
}
```

Daftarkan di `DatabaseSeeder.php`:

```php
public function run(): void
{
    $this->call([
        RolePermissionSeeder::class,
    ]);
}
```

Jalankan seeder:

```bash
php artisan db:seed
```

---

### 12. Contoh Penggunaan Spatie

**Di Blade:**

```blade
@role('admin')
    <p>Hanya admin yang bisa melihat ini.</p>
@endrole

@can('manage users')
    <a href="/users" class="bi bi-people-fill"> Kelola User</a>
@endcan
```

**Di Livewire Component:**

```php
use Livewire\Component;

class UserList extends Component
{
    public function hapusUser(int $id): void
    {
        $this->authorize('manage users');

        \App\Models\User::findOrFail($id)->delete();

        $this->dispatch('user-deleted');
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
```

**Di Route / Controller:**

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
```

---

### 13. Buat Livewire Component

```bash
php artisan make:livewire NamaComponent
```

Contoh `resources/views/livewire/dashboard.blade.php`:

```html
<div class="p-6 bg-white rounded-xl shadow-sm">
    <h1 class="text-2xl font-bold text-gray-800">
        <i class="bi bi-speedometer2 mr-2 text-blue-500"></i>
        Dashboard
    </h1>
    <p class="mt-2 text-gray-500">
        Selamat datang, {{ auth()->user()->name }}!
    </p>
</div>
```

---

### 14. Jalankan Aplikasi (Development)

Gunakan script `dev` yang sudah dikonfigurasi di `composer.json` — menjalankan semua service sekaligus:

```bash
composer run dev
```

Perintah ini menjalankan secara bersamaan:

- `php artisan serve` — web server Laravel
- `php artisan queue:listen` — queue worker
- `php artisan pail` — log viewer real-time
- `npm run dev` — Vite hot reload

Buka browser: **http://localhost:8000**

---

### Build untuk Production

```bash
npm run build
php artisan optimize
```

---

## 📁 Struktur Direktori Penting

```
├── app/
│   ├── Livewire/                   # Livewire components
│   └── Models/
│       └── User.php                # HasRoles trait dari Spatie
├── database/
│   ├── migrations/
│   └── seeders/
│       └── RolePermissionSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css                 # Tailwind v4 + Bootstrap Icons
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── components/
│       │   └── layouts/
│       │       └── app.blade.php   # Layout utama
│       └── livewire/               # Livewire views
├── .env
├── composer.json
└── vite.config.js
```

---

## 🧪 Perintah Artisan yang Sering Dipakai

```bash
# Buat Livewire component baru
php artisan make:livewire NamaComponent

# Buat model + migration + controller
php artisan make:model NamaModel -mcr

# Reset database dan seed ulang
php artisan migrate:fresh --seed

# Clear semua cache
php artisan optimize:clear

# Jalankan test
composer run test
```

---

## 📚 Referensi

- [Laravel 13 Docs](https://laravel.com/docs/13.x)
- [Livewire 4 Docs](https://livewire.laravel.com)
- [Tailwind CSS v4 Docs](https://tailwindcss.com/docs)
- [Spatie Permission v7 Docs](https://spatie.be/docs/laravel-permission/v7)
- [Bootstrap Icons](https://icons.getbootstrap.com)

---

> Made with ❤️ using Laravel 13 · Livewire 4 · Tailwind v4
