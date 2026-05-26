<?php

function pdo() {
    static $pdo = null;

    if($pdo === null) {
        require __DIR__."/config.php";
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }      
    return $pdo;

}

function get_current_poll() {
    $db = pdo();
    $row = $db->query("SELECT current_poll_id FROM settings WHERE id = 1")->fetch();
    
    if(!$row || !$row['current_poll_id']) { return null; }   
}