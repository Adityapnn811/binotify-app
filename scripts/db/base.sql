CREATE TABLE IF NOT EXISTS User (
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    password varchar(256) NOT NULL,
    username varchar(256) NOT NULL,
    is_admin boolean NOT NULL
);

CREATE TABLE IF NOT EXISTS Album (
    album_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    Judul varchar(64) NOT NULL,
    Penyanyi varchar(64) NOT NULL,
    Total_duration int NOT NULL,
    Image_path varchar(256) NOT NULL,
    Tanggal_terbit date NOT NULL,
    Genre varchar(64)
);

CREATE TABLE IF NOT EXISTS Song (
    song_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    Judul varchar(64) NOT NULL,
    Penyanyi varchar(64),
    Tanggal_terbit date NOT NULL,
    Genre varchar(64),
    Duration int NOT NULL,
    Audio_path varchar(256) NOT NULL,
    Image_path varchar(256) NOT NULL,
    album_id int,
    FOREIGN KEY (album_id) REFERENCES Album (album_id)
);

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album coba', 'coba', 70, '/img/album.jpg', '2022-10-10', 'pop');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album coba 2', 'coba', 70, '/img/album.jpg', '2022-10-10', 'rock');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album coba 33', 'coba', 70, '/img/album.jpg', '2022-10-10', 'blues');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album coba 4', 'coba', 70, '/img/album.jpg', '2022-10-10', 'techno');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Blurryface', 'Twenty One Pilots', 70, './img/blurryface.png', '2022-10-10', 'alt rock');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album Foto', 'Kamera', 70, '/img/album.jpg', '2022-10-10', 'kamera');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album Foto 2', 'Kamera', 70, '/img/album.jpg', '2022-10-10', 'kamera');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Album Foto 3', 'Kamera', 70, '/img/album.jpg', '2022-10-10', 'kamera');

INSERT INTO Album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre)
VALUES ('Kumpulan Hits', 'YouTube', 70, '/img/album.jpg', '2022-10-10', 'pop');

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 3', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 4', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 5', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 6', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 7', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 8', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 9', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 10', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 11', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('Stressed Out', 'Twenty One Pilots', '2022-10-10', 'alt rock', 10, '/img/', "./img/blurryface.png", 5);

INSERT INTO User (email, password, username, is_admin)
VALUES ('apn725@gmama.com', 'passssss', 'apnn', false);

INSERT INTO User (email, password, username, is_admin)
VALUES ('apn75@gmama.com', 'word', 'apnn2', false);

INSERT INTO User (email, password, username, is_admin)
VALUES ('apn5@gmama.com', 'word', 'apnn23', false);

INSERT INTO User (email, password, username, is_admin)
VALUES ('ap75@gmama.com', 'word', 'apnn24', false);

INSERT INTO User (email, password, username, is_admin)
VALUES ('ap@gmama.com', 'word', 'apnn3', false);