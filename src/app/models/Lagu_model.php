<?php
    class Lagu_model {
        private $table = 'Song';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function searchSong(){
            // BELOM NGITUNG MAKS
            $q = $_POST["q"];
            $tahun = $_POST["q"];
            $sort = $_POST["sort"];
            $genre = rtrim($_POST["genre"], ",");
            $genre = explode(",", $genre);
            $genre = implode("', '", $genre);
            $page = (int) $_POST["page"];
            $offset = 10 * ($page-1);

            if (is_numeric($q)) {
                $tahun = (int) $q;
            }

            if ($genre === "") {
                $query = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun ORDER BY Judul $sort LIMIT 10 OFFSET :offset";
            } else {
                $query = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun)  ORDER BY Judul $sort LIMIT 10 OFFSET :offset";
            }

            $this->db->query($query);
            $this->db->bind('q', "%$q%");
            $this->db->bind('tahun', $tahun);
            $this->db->bind('offset', $offset);

            
            return $this->db->rowCount();

        }

        public function countSearchRow(){
            $q = $_POST["q"];
            $tahun = $_POST["q"];
            $sort = $_POST["sort"];
            $genre = rtrim($_POST["genre"], ",");
            $genre = explode(",", $genre);
            $genre = implode("', '", $genre);
            $page = (int) $_POST["page"];
            $offset = 10 * ($page-1);

            if (is_numeric($q)) {
                $tahun = (int) $q;
            }

            if ($genre === "") {
                $query = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun";
                
            } else {
                $query = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun)";
            }

            $this->db->query($query);
            $this->db->bind('q', "%$q%");
            $this->db->bind('tahun', $tahun);
            $this->db->execute();

            return (int) ceil($this->db->rowCount()/10);
        }

    }
?>