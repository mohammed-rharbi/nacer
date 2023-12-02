<?php
$server_name = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$server_name;dbname=myspace", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
