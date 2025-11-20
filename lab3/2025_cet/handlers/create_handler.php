<?php

include "../database/db_connection.php";
session_start();

require "../jwt_helper.php";

if(!isset($_SESSION["jwt"]) || !decodeJWT($_SESSION["jwt"])) {
    header("Location: ../pages/auth/login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $location = $_POST["location"] ?? "";
    $date = $_POST["date"] ?? "";
    $price = $_POST["price"] ?? 0;
    $type = $_POST["type"] ?? "";

    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO cameras (name, location, date, price, type) VALUES (:name, :location, :date, :price, :type)");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':type', $type);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error adding expense: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method.";
}