<?php    
    class Upload extends Controller {
        // method default adalah index (harus ada)

        public function index($upType) {
            $data["upType"] = $upType;
            $headerData["URLRedirect"] = "/home";
            $this->view('templates/headerRedirectWithoutBody', $headerData);
            $this->view('upload/index', $data);
            $this->view('templates/footerWithoutBody');
        }

        public function postSongInsert()
        {
            $judul = $_POST["Judul"];
            $penyanyi = $_POST["Penyanyi"];
            $tanggal = $_POST["Tanggal"];
            $genre = $_POST["Genre"];
            $duration = $_POST["Duration"];
            $audio_path = $_POST["Audio_path"];
            $image_path = $_POST["Image_path"];
            $data["status"] = $this->model("Lagu_model")->insertSong($judul, $penyanyi, $tanggal, $genre, $duration, $audio_path, $image_path);
            $this->view("upload/postSongInsert", $data);
        }

        public function postAlbumInsert()
        {
            $judul = $_POST["Judul"];
            $penyanyi = $_POST["Penyanyi"];
            $tanggal = $_POST["Tanggal"];
            $genre = $_POST["Genre"];
            $image_path = $_POST["Image_path"];
            $data["status"] = $this->model("Album_model")->insertAlbum($judul, $penyanyi, $image_path, $tanggal, $genre);
            $this->view("upload/postAlbumInsert", $data);
        }

        public function uploadSong()
        {
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
            $this->view("upload/uploadSong", $data);
        }

        public function uploadCover()
        {
            $name = $_FILES["file"]["name"];
            $tmp = $_FILES["file"]["tmp_name"];
            $error = $_FILES["file"]["error"];
            $image_path = "./img/" . $name;
            if ($error === 0 && move_uploaded_file($tmp, $image_path)) {
                $data["name"] = $name;
                $data["Image_path"] = $image_path;
            } else {
                $data["status"] = 500;
            }
            $this->view("upload/uploadCover", $data);
        }
    }
?>