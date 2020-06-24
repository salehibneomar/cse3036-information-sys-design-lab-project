<?php

    interface AdRepository{
        public function createAd($ad);
        public function viewAdById($id);
        public function deleteAdById($id);
        public function updateAdById($id, $updatedInfo);
    }

?>