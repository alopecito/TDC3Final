<?php

//Login data for the database. Use this file in all Models

function connect_db() {
    
    $host = 'localhost';
    $dbname ='mcgillproject';
    $user = 'root';
    $passwd = '';

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_PERSISTENT, true);

    return $db;
}
