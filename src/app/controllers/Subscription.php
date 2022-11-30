<?php
    class Subscription extends Controller {
        public function createRequest(){
            $creatorId = $_POST["creatorId"];
            $subscriberId = $_POST["subscriberId"];
            $data["status"] = $this->model("Subscription_model")->createRequest($creatorId, $subscriberId);
            $this->view('subscription/result', $data);
        }

        public function approveRequest(){
            $creatorId = $_POST["creatorId"];
            $subscriberId = $_POST["subscriberId"];
            $data["status"] = $this->model("Subscription_model")->approveRequest($creatorId, $subscriberId);
            $this->view('subscription/result', $data);
        }

        public function rejectRequest(){
            $creatorId = $_POST["creatorId"];
            $subscriberId = $_POST["subscriberId"];
            $data["status"] = $this->model("Subscription_model")->rejectRequest($creatorId, $subscriberId);
            $this->view('subscription/result', $data);
        }
    }
?>