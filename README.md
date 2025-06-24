## 🚀 Tech Stack

- **Framework Backend:** Laravel 10
- **Styling:** Bootstrap 5
- **Database:** MySQL

---

## 🛠️ Cara Instalasi dan Menjalankan Proyek

Pastikan Anda sudah memiliki PHP dan Composer di lingkungan Anda.

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/keyfarel/pos_project.git](https://github.com/keyfarel/compfest-sea-submission.git)
   ```

    ```bash
   cd pos_project
   ```

2. **Install Dependensi**
   ```bash
   composer install
   ```

3. **Setup File Environment**
   Salin file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```

4. **Generate Kunci Aplikasi**
   ```bash
   php artisan key:generate
   ```

5. **Setup Database**
   Buat sebuah database baru di MySQL untuk proyek ini (contoh: pos_project).
   Buka file .env dan sesuaikan konfigurasi database berikut dengan kredensial Anda:
   Cuplikan kode
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username_database
   DB_PASSWORD=password_database
   ```

6. **Migrasi Database**
   Jalankan Migrasi dan Seeding Database
   Perintah ini akan membuat semua tabel yang diperlukan dan mengisinya dengan data awal (dummy data).
   ```bash
   php artisan migrate --seed
   ```
   
7. **Jalankan Server Development**
   Jalankan perintah ini di **satu terminal**. Perintah ini akan menyalakan server Laravel
   ```bash
   php artisan serve 
   ```

8. **Buka di Browser**
   Buka browser Anda dan kunjungi alamat berikut:
   [http://localhost:8000](http://localhost:8000)
