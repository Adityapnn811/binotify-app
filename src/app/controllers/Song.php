<?php
    class Song extends Controller {
        // method default adalah index (harus ada)
        public function index($id, $edit = "no"){
            $data["id"] = $id;
            $data["edit"] = $edit;
            $this->view('templates/headerEditRedirect', $data);
            $this->view('song/index', $data);
            $this->view('templates/footerWithoutBody');
        }

        // Tambahin page/api di bawah
        public function getSongById($id) {
            $data["song"] = $this->model("Lagu_model")->getSongById($id);
            $this->view("song/getSongById", $data);
        }

        public function getAlbumNameById($id) {
            $data["name"] = $this->model("Album_model")->getAlbumNameById($id);
            $this->view("song/getAlbumNameById", $data);
        }

        public function postSongUpdate() {
            $id = $_POST["id"];
            $judul = $_POST["Judul"];
            $tanggal = $_POST["Tanggal"];
            $genre = $_POST["Genre"];
            $data["id"] = $id;
            $data["status"] = $this->model("Lagu_model")->updateSongById($id, $judul, $tanggal, $genre);
            $this->view("song/postSongUpdate", $data);
        }
    }
?>