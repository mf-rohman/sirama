# SIRAMA - Sistem Informasi Dokumen Dosen

![Logo UNIROW](https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZY0pJFNty0yVUGk4zshRHkYLk30mWklia1g&s)
![Logo Kampus Berdampak](https://blogger.googleusercontent.com/img/a/AVvXsEgHACtzWN-wrZLKuKjJHDg_jIqTVXAHe8YtLlluLC8UH41bclJ-prgUlx4fssv-vdOXDqtNLODvidYU3iP-FycB-UtwByHjnhEmK-6GuQZ2YU1JphSScFXP13x6nxH60SZRnpOyp1bl9Ef_4OVfJyqegnjjZ8yKxrNoYVAV7YiH_9yDYuwTSloDa-gybDg=s364)

## Tentang Aplikasi

**SIRAMA** adalah aplikasi web yang dirancang untuk membantu para dosen di **Universitas PGRI Ronggolawe (UNIROW) Tuban** dalam mengelola dan mengarsipkan dokumen-dokumen penting yang berkaitan dengan kegiatan akademik dan tridharma perguruan tinggi.

Aplikasi ini bertujuan untuk memusatkan penyimpanan dokumen, mempermudah proses pencarian, dan memastikan keamanan data. Dengan SIRAMA, dosen dapat dengan mudah mengunggah, mengkategorikan, dan mengakses kembali dokumen seperti sertifikat, surat tugas, bahan ajar, laporan penelitian, dan dokumen penting lainnya.

---

## Fitur Utama

* **Manajemen Dokumen Terpusat**: Unggah dan simpan semua dokumen dalam satu platform yang aman.
* **Kategorisasi Dokumen**: Kelompokkan dokumen berdasarkan jenis (Pendidikan, Penelitian, Pengabdian, Penunjang) untuk kemudahan organisasi.
* **Pencarian Cepat**: Temukan dokumen yang Anda butuhkan dengan cepat melalui fitur pencarian yang canggih.
* **Keamanan Data**: Dokumen disimpan dengan aman dan hanya dapat diakses oleh pengguna yang berwenang.
* **Antarmuka yang Mudah Digunakan**: Desain yang bersih dan intuitif dibangun dengan Filament, membuat navigasi menjadi mudah.
* **Riwayat Aktivitas**: Lacak riwayat unggahan dan perubahan dokumen.

---

## Teknologi yang Digunakan

* **Backend**: PHP, [Laravel 12](https://laravel.com/)
* **Admin Panel & UI**: [Filament](https://filamentphp.com/)
* **Frontend**: Blade, Tailwind CSS
* **Database**: MySQL / MariaDB
* **Web Server**: Nginx / Apache

---

## Panduan Instalasi

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan lokal.

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/mf-rohman/sirama.git](https://github.com/mf-rohman/sirama.git)
    cd sirama
    ```

2.  **Install Dependensi**
    Pastikan Anda memiliki [Composer](https://getcomposer.org/) terinstal.
    ```bash
    composer install
    ```

3.  **Buat File Environment**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sirama
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.
    ```bash
    php artisan migrate
    ```

7.  **Buat User Admin (Opsional)**
    Anda bisa membuat user admin pertama melalui seeder atau langsung menggunakan `php artisan tinker`.
    ```bash
    php artisan tinker
    ```
    Kemudian jalankan:
    ```php
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@unirow.ac.id',
        'password' => bcrypt('password') // ganti 'password' dengan password yang aman
    ]);
    ```

8.  **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---

## Kontribusi

Kontribusi dalam bentuk apapun sangat kami hargai. Jika Anda menemukan bug atau memiliki ide untuk fitur baru, silakan buat *issue* baru di repositori ini.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE.md).

---
*Dikembangkan untuk Universitas PGRI Ronggolawe Tuban.*
