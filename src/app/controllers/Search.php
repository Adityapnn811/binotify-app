<?php
    class Search extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            // Ngitung total row dulu
            $dataAwal = $this->model("Lagu_model")->searchSong(6);
            $data["lagu"] = $dataAwal[0];
            $data["maxPage"] = $dataAwal[1];

            $this->view('templates/header');
            $this->view('search/index', $data);
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>