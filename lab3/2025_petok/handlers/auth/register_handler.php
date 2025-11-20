<?php
session_start();

require "../../database/db_connection.php";
require "../../jwt_helper.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 3 || strlen($password) < 6) {
        die("too small password or username");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

    try{
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

        echo "Success<a href='../../pages/auth/login.php'>Login here</a>";
    }
    catch (PDOException $e){
        if ($e->getCode() == 23000) {
            die("Корисничкото име веќе постои.");
        } else {
            die("Грешка: " . $e->getMessage());
        }
    }

}