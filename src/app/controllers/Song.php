<?php
    class Song extends Controller {
        // method default adalah index (harus ada)
        public function index($id = 10){
            $data["id"] = $id;
            $this->view('templates/headerWithoutBody');
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
    }
?>