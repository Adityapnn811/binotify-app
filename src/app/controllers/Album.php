<?php
    class Album extends Controller {
        // method default adalah index (harus ada)
        public function index($id) {
            $data["songs"] = $this->model("Lagu_model")->getSongsByAlbumId($id, 1);
            $data["id"] = $id;
            $this->view('templates/headerWithoutBody');
            $this->view('album/index', $data);
            $this->view('templates/footerWithoutBody');
        }

        // Tambahin page/api di bawah
        public function getAlbumById($id) {
            $data["album"] = $this->model("Album_model")->getAlbumById($id);
            $this->view("album/getAlbumById", $data);
        }

        public function getSongsByAlbumId($id, $page) {
            $data["songs"] = $this->model("Lagu_model")->getSongsByAlbumId($id, $page);
            $this->view("album/getSongsByAlbumId", $data);
        }
    }
?>