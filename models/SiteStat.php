<?php
    require_once 'config/DBConnectionSingleton.php';

    class SiteStat{

        private static function getTotal($query){
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc()['total'];
        }

        public static function getSiteStat(){
            $wholeStat=array(
                'totalAds'=> SiteStat::getTotal("SELECT COUNT(ad_id) AS total FROM ad WHERE ad_status=1"),
                'totalUsers'=> SiteStat::getTotal("SELECT COUNT(user_id) AS total FROM user WHERE acc_status!=0"),
                'totalPrimeUsers'=> SiteStat::getTotal("SELECT COUNT(user_id) AS total FROM user WHERE acc_status=3")
            );

            return $wholeStat;
        }
    }


?>