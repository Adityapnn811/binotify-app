<?php
    class Album_model {
        private $table = 'Album';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getAllAlbum($recordPerPage = 10) {
            if (empty($_POST)) {
                $page = 1;
            } else {
                $page = $_POST["page"];
            }
            $query = "SELECT * FROM Album ORDER BY Judul asc";
            $this->db->query($query);
            $result = $this->db->allResult();
            $totalRecord = count($result);
            $maxPage = (int) ceil($totalRecord/$recordPerPage);
            $offset = $recordPerPage * ($page-1);
            $paginatedRes = array_slice($result, $offset, $recordPerPage);
            return array ($paginatedRes, $maxPage);
        }
        
        public function getAlbumById($id) {
            $query = "SELECT * FROM $this->table WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function getAlbumNameById($id) {
            $query = "SELECT Judul FROM $this->table WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function updateAlbumById($id, $post) {
            $id = $post["id"];
            $judul = $post["Judul"];
            $tanggal = $post["Tanggal"];
            $genre = $post["Genre"];
            $image_path = $post["Image_path"];
            $query = "UPDATE $this->table SET Judul = :judul, Tanggal_terbit = :tanggal, Genre = :genre, Image_path = :image_path WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('judul', $judul);
            $this->db->bind('tanggal', $tanggal);
            $this->db->bind('genre', $genre);
            $this->db->bind('image_path', $image_path);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }

        public function deleteAlbumById($id) {
            $query = "DELETE FROM $this->table WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();
        }
        
        public function insertAlbum($judul, $penyanyi, $image_path, $tanggal, $genre)
        {
            $query = "INSERT INTO $this->table (Judul, Penyanyi, Image_path, Tanggal_terbit, Genre) VALUES (:judul, :penyanyi, :image_path, :tanggal, :genre);";
            $this->db->query($query);
            $this->db->bind('judul', $judul);
            $this->db->bind('penyanyi', $penyanyi);
            $this->db->bind('image_path', $image_path);
            $this->db->bind('tanggal', $tanggal);
            $this->db->bind('genre', $genre);
            $result = $this->db->allResult();
            return $result;
        }

        public function getSingerById($id)
        {
            $query = "SELECT Penyanyi FROM $this->table WHERE album_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $result = $this->db->allResult();
            return $result;
        }
    }
?>