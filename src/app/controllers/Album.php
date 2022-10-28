<?php
    class Album extends Controller {
        // method default adalah index (harus ada)
        public function index($id, $edit = "no") {
            if ($edit === "edit") {
                $data["songs"] = $this->model("Lagu_model")->getSongsInAlbumAndNot($id);
            } else {
                $data["songs"] = $this->model("Lagu_model")->getSongsByAlbumId($id, 1);
            }
            $data["id"] = $id;
            $data["edit"] = $edit;
            $this->view('templates/headerEditRedirect', $data);
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

        public function postAlbumUpdate() {
            $id = $_POST["id"];
            $data["id"] = $id;
            $data["status"] = $this->model("Album_model")->updateAlbumById($id, $_POST);
            $this->view("album/postAlbumUpdate", $data);
        }

        public function uploadCover() {
            $name = $_FILES["file"]["name"];
            $tmp = $_FILES["file"]["tmp_name"];
            $error = $_FILES["file"]["error"];
            $image_path = "./img/".$name;
            if ($error === 0 && move_uploaded_file($tmp, $image_path)) {
                $data["name"] = $name;
                $data["Image_path"] = $image_path;
            } else {
                $data["status"] = 500;
            }
            $this->view("album/uploadCover", $data);
        }

        public function deleteAlbum()
        {
            $id = $_POST["id"];
            $this->model("Album_Model")->deleteAlbumById($id);
        }

        public function getSongsInAlbumAndNot($id) {
            $data["songs"] = $this->model("Lagu_model")->getSongsInAlbumAndNot($id);
            $this->view("album/getSongsInAlbumAndNot", $data);
        }

        public function deleteSongFromAlbum() {
            $id = $_POST["song_id"];
            $album_id = $_POST["album_id"];
            $this->model("Lagu_model")->deleteSongFromAlbum($id);
            $data["songs"] = $this->model("Lagu_model")->getSongsInAlbumAndNot($album_id);
            $data["id"] = $album_id;
            $data["edit"] = "edit";
            $this->view('templates/headerEditRedirect', $data);
            $this->view('album/index', $data);
            $this->view('templates/footerWithoutBody');
        }

        public function addSongToAlbum() {
            $id = $_POST["song_id"];
            $album_id = $_POST["album_id"];
            $this->model("Lagu_model")->addSongToAlbum($id, $album_id);
            $data["songs"] = $this->model("Lagu_model")->getSongsInAlbumAndNot($album_id);
            $data["id"] = $album_id;
            $data["edit"] = "edit";
            $this->view('templates/headerEditRedirect', $data);
            $this->view('album/index', $data);
            $this->view('templates/footerWithoutBody');
        }
    }
?>