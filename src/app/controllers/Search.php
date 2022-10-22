<?php
    class Search extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            // Ngitung total row dulu
            $data["lagu"] = $this->model("Lagu_model")->searchSong();
            $data["maxPage"] = $this->model("Lagu_model")->countSearchRow();

            $this->view('templates/header');
            $this->view('search/index', $data);
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>