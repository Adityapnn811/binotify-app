<?php
    class Lagu_premium extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $dataAwal = $this->model("Lagu_model")->getPremiumSong();
            if(!$dataAwal){
                $data = array();
            }else{
                $data = $dataAwal["data"];
            }
            // $data["maxPage"] = $dataAwal[1];

            $this->view('templates/headerRedirectWithoutBody');
            $this->view('lagu_premium/index', $data);
            $this->view('templates/footerWithoutBody');
        }


    }
?>