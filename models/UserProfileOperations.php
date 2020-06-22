<?php 

    require_once 'config/DBConnectionSingleton.php';

    class UserProfileOperations{

        public static function getUserById($id){
            $query="SELECT user_id, joined_date, name, phone_number, email, profile_image_dir, acc_status FROM user WHERE user_id=?";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            return $stmt->get_result();
        }

        public static function updateUserById($id, $name, $phoneNumber, $email, $profileImageDir){
            $query="UPDATE user SET name=?, phone_number=?, email=?, profile_image_dir=? WHERE user_id=? LIMIT 1";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('sssss', $name, $phoneNumber, $email, $profileImageDir, $id);
            $stmt->execute();

            return $stmt;

        }

        public static function checkUserAvailabilityById($id){
            $query="SELECT user_id FROM user WHERE user_id=?";

            $stmt=DBConnectionSingleton::getConnection()->stmt_init();
            $stmt->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            return $stmt->get_result()->num_rows;
        }

    }

?>