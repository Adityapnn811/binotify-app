<?php
    class Penyanyi_model {
        private $db;
        private $soapURL = SOAP_URL;
        public function __construct() {
            $this->db = new Database;
        }

        public function getList(){
            $opts = array('http' =>
                array(
                    'method'  => 'GET',
                    'header'  => 'Content-Type: application/json'
                )
            );
            $context  = stream_context_create($opts);
            $urlnya = "http://binotify-rest:5000/penyanyi";
            $response = file_get_contents($urlnya, false, $context);
            $response = json_decode($response, true);

            return $response["data"];
        }

        public function getListsOAP(){
            $client = new SoapClient($this->soapURL . "/webservice/subscription?wsdl");
            $params = array(
                "apiKey" => SOAP_API_KEY,
            );
            $response = $client->__soapCall("getSubscriptionReq", array($params));
            return $response;
        }
    }
?>