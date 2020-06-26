<?php 

    require 'models/UserRepository.php';

    class UserProfileOperations implements UserRepository{
        public static $defaultImage="profile_pic/default.png";

        public static function updateUserById($id, $name, $phoneNumber, $email, $profileImageDir){
            $query="UPDATE user SET name=?, phone_number=?, email=?, profile_image_dir=? WHERE user_id=? LIMIT 1";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('sssss', $name, $phoneNumber, $email, $profileImageDir, $id);
            $stmt->execute();

            return $stmt->affected_rows;

        }


        public static function updateUserPasswordById($id, $oldPassword, $newPassword){
            $oldPassword=md5(SHA1(strip_tags($oldPassword)));
            $newPassword=md5(SHA1(strip_tags($newPassword)));

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $query="SELECT user_id FROM user WHERE user_id=? AND password=? LIMIT 1";
            $stmt->prepare($query);
            $stmt->bind_param('ss', $id, $oldPassword);
            $stmt->execute();

            if($stmt->get_result()->num_rows!=1){
                return 2;
            }
            else{
                if($oldPassword==$newPassword){
                    return 0;
                }
                else{
                    $query="UPDATE user SET password=? WHERE user_id=? LIMIT 1";
                    $stmt->prepare($query);
                    $stmt->bind_param('ss', $newPassword, $id);
                    $stmt->execute();
                    return $stmt->affected_rows;
                }
            }

        }

    }

?>