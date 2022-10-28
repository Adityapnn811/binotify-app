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
            $duration = $_POST["Duration"];
            $audio_path = $_POST["Audio_path"];
            $image_path = $_POST["Image_path"];
            $data["id"] = $id;
            $data["status"] = $this->model("Lagu_model")->updateSongById($id, $judul, $tanggal, $genre, $duration, $audio_path, $image_path);
            $this->view("song/postSongUpdate", $data);
        }

        public function uploadSong() {
            $name = $_FILES["file"]["name"];
            $tmp = $_FILES["file"]["tmp_name"];
            $error = $_FILES["file"]["error"];
            $audio_path = "./songs/" . $name;
            if ($error === 0 && move_uploaded_file($tmp, $audio_path)) {
                $data["name"] = $name;
                $data["Audio_path"] = $audio_path;

                $getID3 = new getID3;
                $musicFile = $getID3->analyze($audio_path);
                $data["file"] = $musicFile;
                if (isset($musicFile['comments']['picture'][0]['data'])) {
                    $ext = substr($musicFile['comments']['picture'][0]['image_mime'], 6);
                    $img_name = $musicFile['tags']['id3v2']['album'][0] . "." . $ext;
                    $image_path = "./img/" . $img_name;
                    if (file_put_contents($image_path, $musicFile['comments']['picture'][0]['data'])) {
                        $data["img_name"] = $img_name;
                        $data["Image_path"] = $image_path;
                    }
                }
            } else {
                $data["status"] = 500;
            }
            $this->view("song/uploadSong", $data);
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
            $this->view("song/uploadCover", $data);
        }

        public function deleteSong()
        {
            $id = $_POST["id"];
            $this->model("Lagu_model")->deleteSongById($id);
        }

        public function increaseSessionSongCount() 
        {
            if (!isset($_SESSION["song_count"])) {
                $_SESSION["song_count"] = 1;
            }
            $_SESSION["song_count"] += 1;
            $data["song_count"] = $_SESSION["song_count"];
            $this->view("song/song_count", $data);
        }
    }
?>