<?php
    require 'config/config.init.php';
    require 'models/AdOperations.php';

    if(!(isset($_SESSION['user_arr']))){ header("Location: index"); exit();}

    if(isset($_GET['ad_id'])){
        $adId=strip_tags(trim($_GET['ad_id']));
        $userId=$_SESSION['user_arr']['user_id'];
        if(!empty($adId)){
            $adDeleteStatus=AdOperations::deleteAd($userId, $adId);
            if($adDeleteStatus!=1){
                $_SESSION['message']="Error Occured!";
                $_SESSION['alertColor']="alert-danger";
            }
            else{
                $_SESSION['message']="Successfully Deleted!";
                $_SESSION['alertColor']="alert-success";
            }
        }
    }

    header("Location: user-ad-list");

?>