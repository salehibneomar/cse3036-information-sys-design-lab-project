<?php 

    class AdPopo{
        //private $id;
        public $title;
        public $city;
        public $location;
        public $datePosted;
        public $price;
        public $residentialType;
        //public $adStatus;
        //public $userId;
        public $featureInfo;
        public $imageList;

        public function __construct($title, $city, $location, $datePosted, $price, $residentialType, $featureInfo, $imageList){
            $this->title=strip_tags($title);
            $this->city=strip_tags($city);
            $this->location=strip_tags($location);
            $this->datePosted=strip_tags($datePosted);
            $this->price=strip_tags($price);
            $this->residentialType=strip_tags($residentialType);
            $this->featureInfo=$featureInfo;
            $this->imageList=$imageList;
        }

    }

?>