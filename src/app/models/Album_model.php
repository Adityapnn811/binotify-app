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
    }
?>