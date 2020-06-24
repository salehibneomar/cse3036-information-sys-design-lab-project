<?php

    class AdImage{
        public $imageDir;
        public $dateUploaded;
        public $picType;
       // public $adId;

        public function __construct($imageDir, $dateUploaded, $picType){
            $this->imageDir=$imageDir;
            $this->dateUploaded=$dateUploaded;
            $this->picType=$picType;
        }
    }

?>