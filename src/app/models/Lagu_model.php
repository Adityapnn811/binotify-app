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
            
            if ($genre === "") {
                $query = "SELECT * FROM $this->table WHERE Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun ORDER BY Judul $sort";
            } else {
                $query = "SELECT * FROM $this->table WHERE Genre IN ('" . $genre . "') AND (Judul LIKE :q OR Penyanyi LIKE :q OR YEAR(Tanggal_terbit) = :tahun) ORDER BY Judul $sort";
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
    }
?>