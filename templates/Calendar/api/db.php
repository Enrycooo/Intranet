<?php

try {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "intranet";

    // connect to DB
    $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
}
catch (PDOException $e) {
    //throw $th;
}