<?php 

    require_once 'config/DBConnectionSingleton.php';
    include_once 'AdPopo.php';
    include_once 'AdFeature.php';
    include_once 'AdImage.php';

    class AdOperations{

        private function viewAdInformationById($id){
            $query="SELECT info.*, feature.* FROM ad info, ad_feature feature WHERE info.ad_id=? AND feature.ad_id=?";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('ss', $id, $id);
            $stmt->execute();

            return $stmt->get_result();
            
        }

        private function viewAdPicturesById($id){
            $query="SELECT * FROM ad_picture WHERE ad_id=?";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            return $stmt->get_result();
        }

        private function insertAdInfomation($adInfo){
            $query="INSERT INTO ad (title, city, location, date_posted, price, residential_type, user_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            //$stmt->bind_param('sssssss',);
            $stmt->execute();

            return $stmt->num_rows;
        }

        private function insertAdFeature($adFeature){
            $query="INSERT INTO ad_feature (direction, bed, bath, size, floor_level, breif_desc, ad_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            //$stmt->bind_param('sssssss',);
            $stmt->execute();

            return $stmt->num_rows;
        }

        private function insertAdPicture($adPictures){
            $values="";
            $size=count($adPictures);
            for($i=0; $i<$size; ++$i){
                if($i<$size){
                    $values=$values."(1,2,3,4),";
                }
                else{
                    $values=$values."(1,2,3,4)";
                }
            }

            $query="INSERT INTO ad_picture (image_dir, pic_type, date_uploaded, ad_id) VALUES".$values;
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->num_rows;
        }

        //insertAdInfo
        private function getInsertedAdId($userId){
            $query="SELECT ad_id FROM ad WHERE user_id=? ORDER BY ad_id DESC LIMIT 1";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $userId);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc()['ad_id'];
        }

        //Public functions

        public function viewAdById($id){
            $wholeAd=array($this->viewAdInformationById($id), $this->viewAdPicturesById($id));
            return $wholeAd;
        }

        public static function getAllAds(){
            $query="SELECT a.*, u.acc_status, i.image_dir FROM ad a, user u, ad_picture i WHERE u.user_id=a.user_id AND i.ad_id=a.ad_id AND i.pic_type=1 AND a.ad_status=1";
            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();

            return $stmt->get_result();

        }

        public static function getAddListByUserId($id){
            $query="SELECT info.ad_id, info.title, info.date_posted, info.ad_status, pic.image_dir 
                         FROM ad info, ad_picture pic 
                            WHERE info.user_id=? AND info.ad_id=pic.ad_id AND pic.pic_type=1";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            return $stmt->get_result();                
        }

        public function createAd($user_id, $ad){
            
        }
    }

?>