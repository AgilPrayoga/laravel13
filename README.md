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

Perintah ini secara otomatis akan:

1. `composer install` — install semua PHP dependency
2. Salin `.env.example` → `.env` (jika belum ada)
3. Generate `APP_KEY`
4. Jalankan `php artisan migrate:fresh --seed`
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

---

### 4. Install PHP Dependency

```bash
composer install
```
