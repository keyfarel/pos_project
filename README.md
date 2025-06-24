## 🚀 Tech Stack

- **Framework Backend:** Laravel 10
- **Styling:** Bootstrap 5
- **Database:** MySQL

---

## 🛠️ Cara Instalasi dan Menjalankan Proyek

Pastikan Anda sudah memiliki PHP, Composer, dan Node.js/NPM di lingkungan Anda.

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/keyfarel/pos_project.git](https://github.com/keyfarel/compfest-sea-submission.git)
   ```

    ```bash
   cd pos_project
   ```

2. **Install Dependensi Backend**
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

5. **Jalankan Server Development**
   Jalankan perintah ini di **satu terminal**. Perintah ini akan menyalakan server Laravel
   ```bash
   php artisan serve 
   ```

6. **Buka di Browser**
   Buka browser Anda dan kunjungi alamat berikut:
   [http://localhost:8000](http://localhost:8000)
