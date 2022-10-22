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
    Image_path varchar(256),
    album_id int NOT NULL,
    FOREIGN KEY (album_id) REFERENCES Album (album_id)
);