<?php

    class AdFeature{
        public $direction;
        public $bed;
        public $bath;
        public $size;
        public $floorLevel;
        public $briefDesc;

        public function __construct($direction, $bed, $bath, $size, $floorLevel, $briefDesc){
            $this->direction=$direction;
            $this->bed=$bed;
            $this->bath=$bath;
            $this->size=$size;
            $this->floorLevel=$floorLevel;
            $this->briefDesc=$briefDesc;
        }
    }

?>