<?php

//DB connection instance singleton

    class DBConnectionSingleton{

        private static $dbConnectionSingletonObj=null;

        private static $conn=null;
        private static $hostName = "localhost";
        private static $userName = "root";
        private static $dbName = "residential_rental_finding_system";
        private static $userPassword = "";

        private function __construct(){}

        public final static function getConnection(){
            if(is_null(self::$dbConnectionSingletonObj)){

                self::$dbConnectionSingletonObj = new DBConnectionSingleton();

                try{
                    self::$conn = new mysqli(self::$hostName, self::$userName, 
                                             self::$userPassword, self::$dbName);
                }
                catch(Exception $e){}
            }

            return  self::$conn;
        }

        
    }

    //print_r(DBConnectionSingleton::getConnection());

?>