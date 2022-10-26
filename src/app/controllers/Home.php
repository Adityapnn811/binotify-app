<?php
    class Home extends Controller {
        // method default adalah index (harus ada)
        public function index($username='username default'){
            $dataAwal = $this->model("Lagu_model")->showRecentUploadedSong(10);
            $data["lagu"] = $dataAwal[0];
            $data["maxPage"] = $dataAwal[1];

            $this->view('templates/header');
            $this->view('home/index', $data);
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>