# web-balkondes

Website Balkondes Bumiharjo yang sudah dimigrasikan ke CodeIgniter 4.7 dengan dua area utama:
- landing page publik satu halaman
- admin CMS sederhana untuk mengelola hero, layanan, galeri, dan pengaturan website

## Stack

- PHP 8.2+
- CodeIgniter 4.7
- MySQL untuk aplikasi utama
- SQLite in-memory untuk test

## Default Dev URL

- Default `php spark serve` berjalan di `http://192.168.1.4:8000`
- Override tetap bisa dilakukan, misalnya:

```bash
php spark serve --host 0.0.0.0 --port 8080
```

Project `web-balkondes` memakai session dan base URL sendiri agar tidak bentrok dengan project CI lain seperti `C:\laragon\www\pos`. Saat ini `pos` Anda memakai `8080`, jadi `web-balkondes` diposisikan default di `8000`.

## Setup Lokal

1. Install dependency:

```bash
composer install
```

2. Pastikan database MySQL `balkondes_bumiharjo` sudah ada di Laragon.

3. Sesuaikan `.env` jika username/password MySQL Anda berbeda.

4. Jalankan migrasi:

```bash
php spark migrate
```

5. Isi data awal:

```bash
php spark db:seed DatabaseSeeder
```

6. Jalankan server:

```bash
php spark serve
```

## Login Admin Default

- URL: `/admin/login`
- Email: `admin@web-balkondes.test`
- Username: `admin`
- Password: `Admin123!`

Segera ganti password setelah first setup bila project akan dipakai lebih lanjut.

## Struktur Fitur

- `/` menampilkan landing page publik
- `/admin/dashboard` dashboard admin sederhana
- `/admin/site-settings` pengaturan website
- `/admin/hero-slides` CRUD hero slide
- `/admin/services` CRUD layanan
- `/admin/gallery-items` CRUD galeri foto/video

## Upload Media

Media disimpan di:
- `public/uploads/hero`
- `public/uploads/gallery/images`
- `public/uploads/gallery/videos`

Path media disimpan di database sebagai path relatif terhadap folder `public`.

## Testing

Jalankan:

```bash
vendor/bin/phpunit
```

Test yang disiapkan mencakup:
- homepage 200
- login admin
- CRUD sederhana untuk layanan
- helper pembentuk link WhatsApp
