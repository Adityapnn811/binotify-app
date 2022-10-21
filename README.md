## Requirements
1. Extension sql aktif
2. PHP versi 8
3. Cara aktifin extension pergi ke folder tempat kalian install php. Buat file php.ini.
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
