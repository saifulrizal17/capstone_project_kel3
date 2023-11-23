# Sejahtera.id - Aplikasi Keuangan Pribadi Berbasis Website

Selamat datang di repositori **Capstone Project Kelompok 3** kami! "Sejahtera.id" adalah aplikasi keuangan pribadi berbasis website yang kami kembangkan. Dengan fokus pada membantu pengguna mencapai kesejahteraan finansial, aplikasi ini dirancang untuk memberikan solusi cerdas dalam manajemen keuangan pribadi.

### Mengapa Namanya Sejahtera?

Nama "Sejahtera" dipilih karena merujuk pada keadaan sejahtera dan makmur, menciptakan gambaran positif terkait dengan keberhasilan finansial dan kesejahteraan.

## **🙇 Nama Anggota Kelompok:**
* Saiful Rizal
* Aan Bayu Saputra
* Rajendra Anargya
* Salsabila
* Salma Salsabila

## **🗒 Tentang Aplikasi**
### Deskripsi
Sejahtera.id adalah platform keuangan pribadi yang memberikan pengguna kemampuan untuk mengelola dan merencanakan keuangan mereka secara bijaksana. Kami yakin bahwa setiap orang dapat mencapai kesejahteraan finansial, dan Sejahtera.id hadir untuk membantu mengarahkan pengguna menuju tujuan keuangan mereka.

**Teknologi:**
Aplikasi ini dibangun menggunakan Laravel v5.8 dan membutuhkan PHP v7.1 minimal. Jika Anda mengalami kesalahan atau bug selama instalasi atau penggunaan, kemungkinan disebabkan oleh versi PHP yang tidak didukung.

### Fitur Utama
1. **Manajemen Arus Kas:** Memantau dan menganalisis arus kas pribadi untuk mencatat dan mengkategorikan setiap transaksi keuangan, memudahkan pengguna untuk melacak pengeluaran dan pemasukan.
2. **Laporan Laba/Rugi:** Pembuatan laporan laba/rugi untuk memahami performa finansial secara rinci.
3. **Perubahan Modal:** Memantau perubahan modal untuk melihat dampak transaksi terhadap ekuitas pemilik.
4. **Neraca Keuangan:** Menyajikan neraca keuangan untuk melihat posisi keuangan secara menyeluruh.

## **📥 Cara Menggunakan**

1. **Instalasi:**
   - Clone repositori ini ke dalam direktori lokal Anda.
   - Buka terminal dan masuk ke direktori proyek.
   - Pastikan PHP v7.1 terinstal.
   - Jalankan perintah berikut untuk menginstal dependensi Laravel:
     ```bash
     composer install
     ```
   - Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
   - Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
     ```bash
     php artisan key:generate
     ```
   - Jalankan perintah berikut untuk membuat tabel-tabel database:
     ```bash
     php artisan migrate
     ```
   - Jalankan perintah berikut untuk memulai server Laravel:
     ```bash
     php artisan serve
     ```
   - Buka browser dan akses `http://localhost:8000` untuk mengakses aplikasi Sejahtera.id.

