# Dashboard Super Admin - AirBook

## Overview

Dashboard Super Admin adalah panel kontrol untuk mengelola sistem tukar buku dan koordinasi pemberian koin kepada user yang mengajukan tukar buku.

## Fitur Utama

### 1. Dashboard

-   **Statistik Overview**: Melihat total users, pengajuan, dan distribusi koin
-   **Status Pengajuan**: Grafik distribusi status (Disetujui, Menunggu, Ditolak)
-   **Pengajuan Terbaru**: Daftar 5 pengajuan tukar buku terbaru
-   **Quick Actions**: Akses cepat ke review pengajuan, kelola users, dan transaksi koin

### 2. Manajemen Tukar Buku (`/admin/book-exchanges`)

-   **Filter & Search**: Filter berdasarkan status dan pencarian berdasarkan judul, penulis, kode, atau nama user
-   **Daftar Pengajuan**: Tabel lengkap semua pengajuan dengan foto, detail, dan status
-   **Review Detail**: Klik "Detail" untuk melihat informasi lengkap pengajuan

### 3. Detail Pengajuan (`/admin/book-exchanges/{id}`)

-   **Informasi Lengkap**: Judul, penulis, genre, bahasa, kondisi buku
-   **Foto Buku**: Galeri foto yang dapat diperbesar
-   **Info User**: Profil user yang mengajukan
-   **Aksi Review**:
    -   **Setujui**: Tentukan jumlah koin (1-500) yang akan diberikan
    -   **Tolak**: Berikan alasan penolakan

### 4. Manajemen Users (`/admin/users`)

-   **Daftar Users**: Semua user dengan informasi koin dan aktivitas
-   **Detail User**: Riwayat tukar buku, transaksi koin, dan pembelian

### 5. Transaksi Koin (`/admin/coin-transactions`)

-   **Riwayat Lengkap**: Semua transaksi koin (credit/debit)
-   **Tracking**: Monitor aktivitas koin dalam sistem

## Akses Dashboard

### Login Super Admin

-   Email: `superadmin@airbook.com`
-   Password: `superadmin123`

### URL Dashboard

-   Dashboard Utama: `/admin/dashboard`
-   Akses melalui dropdown profil: "🛡️ Super Admin"

## Alur Kerja Review Pengajuan

1. **Notifikasi**: Dashboard menampilkan jumlah pengajuan yang menunggu review
2. **Review**: Masuk ke "Tukar Buku" > Filter "Menunggu Penilaian"
3. **Detail**: Klik "Detail" pada pengajuan yang ingin direview
4. **Evaluasi**: Lihat foto, deskripsi kondisi, dan informasi user
5. **Keputusan**:
    - **Setujui**: Tentukan koin yang pantas (rekomendasi 25-100 koin)
    - **Tolak**: Berikan alasan yang jelas dan konstruktif
6. **Otomatis**: Sistem akan memberikan koin ke user dan mencatat transaksi

## Sistem Koin

### Pemberian Koin

-   **Range**: 1-500 koin per pengajuan
-   **Rekomendasi**:
    -   Kondisi sangat baik: 75-100 koin
    -   Kondisi baik: 50-75 koin
    -   Kondisi cukup: 25-50 koin
    -   Buku langka/populer: +bonus 10-25 koin

### Otomasi

-   Koin otomatis ditambahkan ke akun user
-   Transaksi tercatat di sistem
-   User mendapat notifikasi di riwayat

## Keamanan

-   Hanya user dengan role "Super Admin" yang dapat mengakses
-   Middleware protection pada semua routes admin
-   Error 403 untuk unauthorized access

## Tips Penggunaan

1. Gunakan filter untuk fokus pada status tertentu
2. Review foto dengan cermat sebelum memutuskan
3. Berikan alasan penolakan yang konstruktif
4. Monitor distribusi koin secara berkala
5. Gunakan Quick Actions untuk efisiensi

## Teknologi

-   Laravel 11
-   Tailwind CSS
-   AlpineJS untuk interaktivitas
-   MySQL database
-   File storage untuk foto
