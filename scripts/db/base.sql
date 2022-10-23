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
    Genre varchar(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS Song (
    song_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    Judul varchar(64) NOT NULL,
    Penyanyi varchar(64) NOT NULL,
    Tanggal_terbit date NOT NULL,
    Genre varchar(64) NOT NULL,
    Duration int NOT NULL,
    Audio_path varchar(256) NOT NULL,
    Image_path varchar(256) NOT NULL,
    album_id int,
    FOREIGN KEY (album_id) REFERENCES Album (album_id)
);

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 3', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 4', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 5', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 6', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 7', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 8', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 9', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 10', 'coba', '2022-10-10', 'pop', 10, '/img/', "/img/apa.jpg", 1)

INSERT INTO Song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id)
VALUES ('coba 11', 'coba', '2022-10-10', 'rock', 10, '/img/', "/img/apa.jpg", 1)