<?php

session_start();
require "../../database/db_connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if(strlen($username) < 4 && strlen($password) < 6){
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $db = connectDatabase();
    $smt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

    try {
        $smt->bindParam(":username", $username);
        $smt->bindParam(":password", $hashed_password);
        $smt->execute();

        echo "Register successful!  <a href='../../pages/auth/login.php'>Login here</a>";

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Корисничкото име веќе постои.");
        } else {
            die("Грешка: " . $e->getMessage());
        }
    }
}