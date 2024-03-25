<?php
require_once ("./config/db.class.php");

class phongban {
    public static function get() {
        $db = new Db();
        $sql = "SELECT * FROM phongban";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>