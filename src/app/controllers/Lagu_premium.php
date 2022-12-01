<?php
    class Lagu_premium extends Controller {
        // method default adalah index (harus ada)
        public function index($id_penyanyi){
            
            // $dataAwal = $this->model("Lagu_model")->getPremiumSong($id_penyanyi);
            // if(!$dataAwal){
            //     $data = array();
            // }else{
            //     $data = $dataAwal["data"];
            // }
            $data["id_penyanyi"] = $id_penyanyi;

            // $this->view('templates/headerWithoutBody');
            $this->view('lagu_premium/index', $data);
            // $this->view('templates/footerWithoutBody');
        }


    }
?>