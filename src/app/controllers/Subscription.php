<?php
    class Subscription extends Controller {
        public function createRequest(){
            $creatorId = $_POST["creatorId"];
            $subscriberId = $_POST["subscriberId"];
            $client = new SoapClient(SOAP_URL . "/webservice/subscription?wsdl");
            $params = array(
                "creatorId" => $creatorId,
                "subscriberId" => $subscriberId,
                "apiKey" => SOAP_API_KEY,
            );
            $response = $client->__soapCall("createSubscriptionReq", array($params));
            $array = json_decode(json_encode($response), true);
            if ($array["return"] == true) {
                $data["response"] = $array;
                $data["status"] = $this->model("Subscription_model")->createRequest($creatorId, $subscriberId);
                $this->view('subscription/result', $data);
            }
            $this->view('subscription/result', array("status" => false));

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

        public function checkRequest($subscriberId, $creatorId){
            $client = new SoapClient(SOAP_URL . "/webservice/subscription?wsdl");
            $params = array(
                "creatorId" => $creatorId,
                "subscriberId" => $subscriberId,
                "apiKey" => SOAP_API_KEY,
            );
            $response = $client->__soapCall("checkEndpointRequest", array($params));
            $array = json_decode(json_encode($response), true);
            $this->view('subscription/result', $array);
        }

        public function checkRequestLocal($subscriberId, $creatorId) {
            $array = $this->model("Subscription_model")->checkStatus($subscriberId, $creatorId);
            $this->view('subscription/result', $array);
        }

        public function getStatusById($subscriberId){
            $client = new SoapClient(SOAP_URL . "/webservice/subscription?wsdl", array('cache_wsdl' => WSDL_CACHE_NONE));
            $params = array(
                "subscriberId" => $subscriberId,
                "apiKey" => SOAP_API_KEY,
            );
            $response = $client->__soapCall("getSubscriptionStatusById", array($params));
            $array = json_decode(json_encode($response), true);
            $this->view('subscription/result', $array);
        }
    }
?>