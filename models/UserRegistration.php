<?php

    require_once 'config/DBConnectionSingleton.php';
    include_once 'UserPopo.php';

    class UserRegistration extends User{

        private $defaultImage="profile_pic/default.png";

        public function __construct($name,$phoneNumber,$password,$joinedDate){

            parent::setName($name);
            parent::setPhoneNumber($phoneNumber);
            parent::setPassword($password);
            parent::setJoinedDate($joinedDate);
            parent::setProfileImageDir($this->defaultImage);
        }

        public function createUser(){
            
            $query="INSERT INTO user (joined_date, name, phone_number, password, profile_image_dir) VALUES(?, ?, ?, ?, ?)";

            //Strict bind_param rule: only variables should be passed by reference
            $joinedDate=parent::getJoinedDate();
            $name=parent::getName();
            $phoneNumber=parent::getPhoneNumber();
            $password=parent::getPassword();
            $profileImageDir=parent::getProfileImageDir();

                $stmt=DBConnectionSingleton::getConnection()->stmt_init();
                $stmt->prepare($query);
                $stmt->bind_param('sssss', $joinedDate, $name, $phoneNumber, $password, $profileImageDir);
                $stmt->execute();

            return $stmt;
        }
    }
?>