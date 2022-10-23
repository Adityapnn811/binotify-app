<?php
    class Albums extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $allData = $this->model("Album_model")->getAllAlbum(6);
            $data["albums"] = $allData[0];
            $data["maxPage"] = $allData[1];
            $this->view('templates/header');
            $this->view('albums/index', $data);
            $this->view('templates/footer');
        }
    }
?>