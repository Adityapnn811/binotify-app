<?php
    class Subscription_model {
        private $table = 'Subscription';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function createRequest($creatorId, $subscriberId) {
            $this->db->query("INSERT INTO $this->table(creator_id, subscriber_id) VALUES (:creatorId, :subscriberId)");
            $this->db->bind(':creatorId', $creatorId);
            $this->db->bind(':subscriberId', $subscriberId);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function approveRequest($creatorId, $subscriberId) {
            $this->db->query("UPDATE $this->table SET status = 'ACCEPTED' WHERE creator_id = :creatorId AND subscriber_id = :subscriberId;");
            $this->db->bind(':creatorId', $creatorId);
            $this->db->bind(':subscriberId', $subscriberId);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function rejectRequest($creatorId, $subscriberId) {
            $this->db->query("UPDATE $this->table SET status = 'REJECTED' WHERE creator_id = :creatorId AND subscriber_id = :subscriberId;");
            $this->db->bind(':creatorId', $creatorId);
            $this->db->bind(':subscriberId', $subscriberId);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function getUserSubs($subscriberId) {
            $this->db->query("SELECT * FROM $this->table WHERE subscriber_id = :subscriberId");
            $this->db->bind(':subscriberId', $subscriberId);
            return $this->db->allResult();
        }

        public function checkStatus($subscriberId, $creatorId) {
            $this->db->query("SELECT * FROM $this->table WHERE creator_id = :creatorId AND subscriber_id = :subscriberId");
            $this->db->bind(':creatorId', $creatorId);
            $this->db->bind(':subscriberId', $subscriberId);
            return $this->db->allResult();
        }
    }
?>