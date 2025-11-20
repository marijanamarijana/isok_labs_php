<?php

include "../database/db_connection.php";
session_start();

require "../jwt_helper.php";

if(!isset($_SESSION["jwt"]) || !decodeJWT($_SESSION["jwt"])) {
    header("Location: ../pages/auth/login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $name = $_POST["name"] ?? "";
    $location = $_POST["location"] ?? "";
    $date = $_POST["date"] ?? "";
    $price = $_POST["price"] ?? 0;
    $type = $_POST["type"] ?? "";

    $db = connectDatabase();

    $stmt = $db->prepare("UPDATE cameras SET name = :name, location = :location, date = :date, price = :price, type = :type WHERE id = :id");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error adding expense: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method.";
}
