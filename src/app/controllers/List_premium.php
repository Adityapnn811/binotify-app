<?php
    class List_premium extends Controller {
        public function index() {
            $data["list_penyanyi"] = $this->model("Penyanyi_model")->getList();
            $data["user_subs"] = $this->getUserSubs();
            $this->view('templates/headerWithoutBody');
            $this->view('list_premium/index', $data);
            $this->view('templates/footerWithoutBody');
        }

        public function getUserSubs(){
            $subscriberId = $_SESSION["user_id"];
            $data = $this->model("Subscription_model")->getUserSubs($subscriberId);
            return $data;
        }
    }
?>