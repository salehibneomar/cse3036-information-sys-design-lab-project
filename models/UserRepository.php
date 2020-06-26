<?php

    interface UserRepository{

        public static function updateUserById($id, $name, $phoneNumber, $email, $profileImageDir);
        public static function updateUserPasswordById($id, $oldPassword, $newPassword);
        
    }

?>