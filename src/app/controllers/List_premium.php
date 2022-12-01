<?php
    class List_premium extends Controller {
        public function index() {
            $subscriberId = $_SESSION["user_id"];
            $data["list_penyanyi"] = $this->model("Penyanyi_model")->getList();
            $data["user_subs"] = $this->model("Subscription_model")->getUserSubs($subscriberId);;
            $this->view('templates/headerWithoutBody');
            $this->view('list_premium/index', $data);
            $this->view('templates/footerWithoutBody');
        }
    }
?>