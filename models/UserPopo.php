<?php

    class User{
        private $id;
        private $name;
        private $phoneNumber;
        private $password;
        private $joinedDate;
        private $email;
        private $profileImageDir;
        private $accStatus;

        public function __construct($args){}

        //Setter methods
        public function setId($id){
            $this->id=strip_tags($id);
        }

        public function setName($name){
            $this->name=ucwords(strip_tags($name));
        }

        public function setPhoneNumber($phoneNumber){
            $this->phoneNumber=strip_tags($phoneNumber);
        }

        public function setPassword($password){
            $this->password=md5(SHA1(strip_tags($password)));
        }

        public function setJoinedDate($joinedDate){
            $this->joinedDate=$joinedDate;
        }

        public function setEmail($email){
            $this->email=strip_tags($email);
        }

        public function setProfileImageDir($profileImageDir){
            $this->profileImageDir=strip_tags($profileImageDir);
        }

        public function setAccStatus($accStatus){
            $this->accStatus=$accStatus;
        }

        //Getter methods
        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getPhoneNumber(){
            return $this->phoneNumber;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getJoinedDate(){
            return $this->joinedDate;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getProfileImageDir(){
            return $this->profileImageDir;
        }

        public function getAccStatus(){
            return $this->accStatus;
        }

    }

?>