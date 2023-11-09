<?php

class delivery_users extends database {
    public function getAllDeliveriesOfUser () {
        $sql = "SELECT `delivery_point`.* , `delivery_status`.`status_text` FROM `delivery_point` JOIN `delivery_status` ON `delivery_point`.`status` = `delivery_status`.`id` WHERE `delivery_point`.`deliverer` = " . $_SESSION['user_id']; // logged in deliverer id will come here
        return $this->fetchAllData($sql);
    }

    public function getAllDeliveriesStatusOptions() {
        $sql = "SELECT * FROM `delivery_status`";
        return $this->fetchAllData($sql);
    }

}
