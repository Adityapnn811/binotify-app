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
                $sort = "asc";
                $genre = "";
                $page = 1;
            } else {
                $q = $_POST["q"];
                $tahun = $_POST["q"];
                $sort = $_POST["sort"];
                $genre = rtrim($_POST["genre"], ",");
                $genre = str_replace(" ", "", $genre);
                $genre = explode(",", $genre);
                $genre = implode("', '", $genre);
                $page = (int) $_POST["page"];
                if (is_numeric($q)) {
                    $tahun = (int) $q;
                }
            }
            $offset = $recordPerPage * ($page-1);
            
            if ($genre === "") {
                $queryCount = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun";
            } else {
                $queryCount = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun)";
            }
            // Jalankan query count dulu
            $this->db->query($queryCount);
            $this->db->bind('q', "%$q%");
            $this->db->bind('tahun', $tahun);
            $this->db->execute();
            $maxPage = (int) ceil($this->db->rowCount()/$recordPerPage);

            
            return array ($this->db->allResult(), $maxPage);

        }

    }
?>