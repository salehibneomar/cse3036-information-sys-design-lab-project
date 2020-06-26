<?php

    class AdReport{
        public $reason;
        public $date;
        public $adId;
        public $userId;

        public function __construct($reason, $date, $adId, $userId){
            $this->reason=$reason;
            $this->date=$date;
            $this->adId=$adId;
            $this->userId=$userId;
        }
    }

?>