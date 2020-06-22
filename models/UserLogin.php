<?php 
    require_once 'config/DBConnectionSingleton.php';
    include_once 'UserPopo.php';

    Class UserLogin extends User{

        private $result=null;

        public function __construct($phoneNumber, $password){
            parent::setPhoneNumber($phoneNumber);
            parent::setPassword($password);
        }

        private final function userLoginProcess(){
            $query = "SELECT user_id, joined_date, name, phone_number, email, profile_image_dir, acc_status
                           FROM user WHERE phone_number = ? AND password = ?";

            //Strict bind_param rule: only variables should be passed by reference
            $phoneNumber=parent::getPhoneNumber();
            $password=parent::getPassword();

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('ss', $phoneNumber, $password);
            $stmt->execute();

            return $stmt->get_result();
        }

        public function getUser(){

            if($this->userLoginProcess()->num_rows==1){
                $this->result=$this->userLoginProcess();
            }

            return $this->result;

        }
    }

?>