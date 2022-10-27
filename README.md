# Website Pemutar Lagu Binotify - Monolithic PHP & Vanilla Web Application

## Daftar Isi
- [Deskripsi](#deskripsi)
- [Requirements](#requirements)
- [Cara instalasi](#cara-instalasi)
- [Cara menjalankan server](#cara-menjalankan-server)
- [Screenshot](#screenshot)
- [Pembagian tugas](#pembagian-tugas)

## Deskripsi
Wesbite binotify merupakan sebuah website pemutar lagu yang dibuat menggunakan bahasa pemrograman PHP sebagai backend dan HTML, CSS, Javascript sebagai frontend. Website ini dibuat tanpa menggunakan framework. Website ini dapat melakukan login dan register sebagai pengguna biasa. Pengguna terbagi menjadi tiga, yaitu pengguna yang terautentikasi, admin, dan pengguna yang tidak terautentikasi. Ketika masuk sebagai admin, maka website akan menampilkan beberapa menu yang hanya bisa diakses oleh admin seperti daftar users, tambah lagu/album, dan edit lagu/album. Perbedaan antara pengguna yang terautentikasi dan tidak terautentikasi adalah pengguna yang tidak terautentikasi hanya bisa memainkan lagu sebanyak 3 kali per hari. 

## Requirements
1. Extension sql aktif
2. PHP versi 8
3. Docker versi 3.8 ke atas
4. Cara aktifin extension pergi ke folder tempat kalian install php. Buat file php.ini.
Masukkan line berikut:
```
extension=pdo_mysql
extension=mysqli
```


## Panduan menjalankan
1. Setup database kalian
2. Ubah variabel database di file index.php
3. Import base.sql dari scripts/db ke database kalian dengan command `mysql -u username -p database_name < file.sql`
4. Pindah ke direktori src
5. Jalankan php dengan `php -S localhost:8080`

## Panduan menjalankan dengan docker
1. Install docker
2. Clone repo ini
3. Jalankan command `docker-compose up`
