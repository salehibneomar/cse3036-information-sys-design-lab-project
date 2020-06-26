<?php 

    require_once 'config/DBConnectionSingleton.php';
    include_once 'AdPopo.php';
    include_once 'AdFeature.php';
    include_once 'AdImage.php';
    include_once 'AdReport.php';

    class AdOperations{

        private static function getAdInformationById($adId){
            $query="SELECT u.user_id, u.name, u.email, u.phone_number, info.*, feature.* FROM user u, ad info, ad_feature feature 
                    WHERE info.ad_id=? AND u.user_id=info.user_id AND info.ad_status=1 AND info.ad_id=feature.ad_id";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $adId);
            $stmt->execute();

            return $stmt->get_result();
            
        }

        private static function getAdPicturesById($adId){
            $query="SELECT * FROM ad_picture WHERE ad_id=?";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $adId);
            $stmt->execute();

            return $stmt->get_result();
        }

        private static function insertAdInfomation($title, $city, $location, $datePosted, $price, $residentialType, $userId){
            $query="INSERT INTO ad (title, city, location, date_posted, price, residential_type, user_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('sssssss', $title, $city, $location, $datePosted, $price, $residentialType, $userId);
            $stmt->execute();

            return $stmt->affected_rows;
        }

        private static function insertAdFeature($direction, $bed, $bath, $size, $floorLevel, $briefDes, $adId){
            $query="INSERT INTO ad_feature (direction, bed, bath, size, floor_level, breif_desc, ad_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('sssssss', $direction, $bed, $bath, $size, $floorLevel, $briefDes, $adId);
            $stmt->execute();

            return $stmt->affected_rows;
        }

        private static function insertAdPictures($adPictures, $adId){
            $values="";
            $size=count($adPictures);
            for($i=0; $i<$size; ++$i){
                $imageDir=$adPictures[$i]['imageDir'];
                $picType=$adPictures[$i]['picType'];
                $dateUploaded=$adPictures[$i]['dateUploaded'];
                
                if($i<$size-1){
                    $values=$values."('$imageDir', '$picType', '$dateUploaded', '$adId'),";
                }
                else{
                    $values=$values."('$imageDir', '$picType', '$dateUploaded', '$adId')";
                }
            }

            $query="INSERT INTO ad_picture (image_dir, pic_type, date_uploaded, ad_id) VALUES".$values;
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->affected_rows;
        }

    
        private static function getInsertedAdId($userId){
            $query="SELECT ad_id FROM ad WHERE user_id=? ORDER BY ad_id DESC LIMIT 1";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $userId);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc()['ad_id'];
        }

        private static function deleteQuery($query){
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->affected_rows;
        }

        private static function adReportDuplicacyCheck($adId, $userId){
            $query="SELECT * FROM ad_report WHERE ad_id=? AND user_id=?";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('ss', $adId, $userId);
            $stmt->execute();

            return $stmt->get_result()->num_rows;
        }
        //Public functions

        public static function viewAdById($adId){
            $wholeAd=array(AdOperations::getAdInformationById($adId), AdOperations::getAdPicturesById($adId));
            return $wholeAd;
        }

        public static function getAllAds(){
            $query="SELECT a.*, u.acc_status, i.image_dir FROM ad a, user u, ad_picture i WHERE u.user_id=a.user_id AND i.ad_id=a.ad_id AND i.pic_type=1 AND a.ad_status=1 ORDER BY u.acc_status DESC, a.date_posted DESC, a.ad_id DESC";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->get_result();
        }

        public static function getAddListByUserId($id){
            $query="SELECT info.ad_id, info.title, info.date_posted, info.ad_status, pic.image_dir 
                         FROM ad info, ad_picture pic 
                            WHERE info.user_id=? AND info.ad_id=pic.ad_id AND pic.pic_type=1 AND info.ad_status=1";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            return $stmt->get_result();                
        }

        public static function createAd($ad, $userId){
            $adInfoCreationStatus=self::insertAdInfomation($ad['title'],$ad['city'],$ad['location'],$ad['datePosted'],$ad['price'],$ad['residentialType'],$userId);
            usleep(100000);
            if($adInfoCreationStatus!=1){
                return -1;
            }
            else{
                $adId=self::getInsertedAdId($userId);
                usleep(100000);
                $adFeatureCreationStatus=self::insertAdFeature($ad['featureInfo']['direction'], $ad['featureInfo']['bed'], $ad['featureInfo']['bath'], $ad['featureInfo']['size'], $ad['featureInfo']['floorLevel'], $ad['featureInfo']['briefDesc'], $adId);
                usleep(100000);

                if($adFeatureCreationStatus!=1){
                    $query="DELETE FROM ad WHERE ad_id='$adId'";
                    self::deleteQuery($query);
                    return -1;
                }
                else{
                    $count=count($ad['imageList']);
                    $adPicturesCreationStatus=self::insertAdPictures($ad['imageList'], $adId);
                    
                    if($adPicturesCreationStatus!=$count || $adPicturesCreationStatus<=0){
                        $query="DELETE FROM ad_picture WHERE ad_id='$adId'";
                        self::deleteQuery($query);
                        usleep(100000);
                        $query="DELETE FROM ad_feature WHERE ad_id='$adId'";
                        self::deleteQuery($query);
                        usleep(100000);
                        $query="DELETE FROM ad WHERE ad_id='$adId'";
                        self::deleteQuery($query);

                        return -1;
                    }
                    else{
                        return 1;
                    }
                }
            }
        }

        public static function adReport($report){
            $hasDuplicate=AdOperations::adReportDuplicacyCheck($report['adId'], $report['userId']);
            if($hasDuplicate==1){
                return 2;
            }
            else{
                $query="INSERT INTO ad_report (reason, date, ad_id, user_id) VALUES(?, ?, ?, ?)";
                $stmt=DBConnectionSingleton::getConnection()->stmt_init();
                $stmt->prepare($query);
                $stmt->bind_param('ssss', $report['reason'], $report['date'], $report['adId'], $report['userId']);
                $stmt->execute();
    
                return $stmt->affected_rows;

            }
        }


        public static function deleteAd($userId, $adId){
            $imageResults=AdOperations::getAdPicturesById($adId);
            $operationStatus=-1;

            $deleteAdImages=AdOperations::deleteQuery("DELETE FROM ad_picture WHERE ad_id='$adId'");
            if($deleteAdImages>=1){
                usleep(100000);
                $deleteAdFeatures=AdOperations::deleteQuery("DELETE FROM ad_feature WHERE ad_id='$adId' LIMIT 1");
                if($deleteAdFeatures==1){
                    usleep(100000);
                    $deleteAdReports=AdOperations::deleteQuery("DELETE FROM ad_report WHERE ad_id='$adId'");
                    usleep(100000);
                    $deleteAd=AdOperations::deleteQuery("DELETE FROM ad WHERE ad_id='$adId' AND user_id='$userId' LIMIT 1");

                    if($deleteAd==1){
                    
                        while($img=$imageResults->fetch_assoc()){
                            unlink($img['image_dir']);
                        }

                        $operationStatus=1;
                    }
                    
                }
            }

            return $operationStatus;
        }

    }

?>