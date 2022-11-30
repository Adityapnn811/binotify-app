<?php
    class Lagu_premium extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $dataAwal = $this->model("Lagu_model")->showRecentUploadedSong(10);
            $data["lagu"] = $dataAwal[0];
            $data["maxPage"] = $dataAwal[1];

            $this->view('templates/headerRedirectWithoutBody');
            $this->view('lagu_premium/index', $data);
            $this->view('templates/footerWithoutBody');
        }
    }
?>