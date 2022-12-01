<?php
    class Lagu_model {
        private $table = 'Song';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function searchSong($recordPerPage = 10) {
            if (count($_POST) === 0) {
                $q ="";
                $tahun = "";
                $sort = "";
                $sortYear = '';
                $genre = "";
                $page = 1;
            } else {
                $q = $_POST["q"];
                $tahun = $_POST["q"];
                $sort = strtolower($_POST["sort"]);
                $sortYear = strtolower($_POST["sortYear"]);
                $genre = rtrim($_POST["genre"], ",");
                $genre = explode(",", $genre);
                foreach ($genre as $key => $value) {
                    $genre[$key] = trim($value, " ");
                }
                $genre = implode("', '", $genre);
                $page = (int) $_POST["page"];
                if (is_numeric($q)) {
                    $tahun = (int) $q;
                }
            }
            $offset = $recordPerPage * ($page-1);
            
            if ($genre === "") {
                $query = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun";
            } else {
                $query = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun)";
            }
            if ($sort != '' || $sortYear != '') {
                $query .= " ORDER BY ";
            }
            if ($sort != '' && $sortYear != '') {
                $query .= "Judul $sort, Tanggal_terbit $sortYear";
            } else if ($sort != '' || $sortYear != '') {
                if ($sort != '') {
                    $query .= "Judul $sort";
                } else {
                    $query .= "Tanggal_terbit $sortYear";
                }
            }
            // Jalankan query count dulu
            $this->db->query($query);
            $this->db->bind('q', "%$q%");
            $this->db->bind('tahun', $tahun);

            $result = $this->db->allResult();
            $totalRecord = count($result);
            $maxPage = (int) ceil($totalRecord/$recordPerPage);
            $paginatedRes = array_slice($result, $offset, $recordPerPage);

            return array ($paginatedRes, $maxPage);
        }

        public function getSongById($id) {
            $query = "SELECT * FROM $this->table WHERE song_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function getSongsByAlbumId($id, $page, $recordPerPage = 10) {
            $query = "SELECT * FROM $this->table WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            $totalRecord = count($result);
            $maxPage = (int) ceil($totalRecord / $recordPerPage);
            $offset = $recordPerPage * ($page - 1);
            $paginatedRes = array_slice($result, $offset, $recordPerPage);
            return array($paginatedRes, $maxPage, $totalRecord);
        }

        public function updateSongById($id, $judul, $tanggal, $genre, $duration, $audio_path, $image_path) {
            $query = "UPDATE $this->table SET Judul = :judul, Tanggal_terbit = :tanggal, Genre = :genre, Duration = :duration, Audio_path = :audio_path, Image_path = :image_path WHERE song_id = :id";
            $this->db->query($query);
            $this->db->bind('judul', $judul);
            $this->db->bind('tanggal', $tanggal);
            $this->db->bind('genre', $genre);
            $this->db->bind('duration', $duration);
            $this->db->bind('audio_path', $audio_path);
            $this->db->bind('image_path', $image_path);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function showRecentUploadedSong($recordPerPage = 10) {
            if (count($_POST) === 0) {
                $q ="";
                $tahun = "";
                $sort = "asc";
                $genre = "";
                $page = 1;
            } else {
                $q = $_POST["q"];
                $tahun = $_POST["q"];
                $sort = strtolower($_POST["sort"]);
                $genre = rtrim($_POST["genre"], ",");
                $genre = explode(",", $genre);
                foreach ($genre as $key => $value) {
                    $genre[$key] = trim($value, " ");
                }
                $genre = implode("', '", $genre);
                $page = (int) $_POST["page"];
                if (is_numeric($q)) {
                    $tahun = (int) $q;
                }
            }
            $offset = $recordPerPage * ($page-1);
            
            // if ($genre === "") {
            //     $query = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun ORDER BY Judul $sort";
            // } else {
            //     $query = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun) ORDER BY Judul $sort";
            // }

            $query = "SELECT * FROM (SELECT * FROM `Song` ORDER BY song_id DESC LIMIT 10) as terakhir ORDER BY Judul ASC";

            // Jalankan query count dulu
            $this->db->query($query);
            // $this->db->bind('q', "%$q%");
            // $this->db->bind('tahun', $tahun);

            $result = $this->db->allResult();
            $totalRecord = count($result);
            $maxPage = (int) ceil($totalRecord/$recordPerPage);
            $paginatedRes = array_slice($result, $offset, $recordPerPage);

            return array ($paginatedRes, $maxPage);
        }

        public function deleteSongById($id)
        {
            $query = "DELETE FROM $this->table WHERE song_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function getSongsInAlbumAndNot($id, $penyanyi) {
            $query = "SELECT * FROM $this->table WHERE album_id = :id OR (album_id IS NULL AND Penyanyi = :penyanyi)";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->bind('penyanyi', $penyanyi);
            return $this->db->allResult();
        }

        public function deleteSongFromAlbum($id) {
            $query = "UPDATE $this->table SET album_id = NULL WHERE song_id = :id ";
            $this->db->query($query);
            $this->db->bind('id', $id);
            return $this->db->allResult();
        }

        public function addSongToAlbum($id, $album_id_now) {
            $query = "UPDATE $this->table SET album_id = :album_id WHERE song_id = :id ";
            $this->db->query($query);
            $this->db->bind('album_id', $album_id_now);
            $this->db->bind('id', $id);
            return $this->db->allResult();
        }

        public function insertSong($judul, $penyanyi, $tanggal, $genre, $duration, $audio_path, $image_path)
        {
            $query = "INSERT INTO $this->table (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path) VALUES (:judul, :penyanyi, :tanggal, :genre, :duration, :audio_path, :image_path);";
            $this->db->query($query);
            $this->db->bind('judul', $judul);
            $this->db->bind('penyanyi', $penyanyi);
            $this->db->bind('tanggal', $tanggal);
            $this->db->bind('genre', $genre);
            $this->db->bind('duration', $duration);
            $this->db->bind('audio_path', $audio_path);
            $this->db->bind('image_path', $image_path);
            $result = $this->db->allResult();
            return $result;
        }

    }
?>