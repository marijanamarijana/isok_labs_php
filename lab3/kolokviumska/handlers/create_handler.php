<?php
session_start();

include "../database/db_connection.php";
include "../jwt_helper.php";

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $date = $_POST["date"];
    $amount = $_POST["amount"];
    $pay = $_POST["pay"];

    $db = connectDatabase();
    $smt = $db->prepare("INSERT INTO expenses (name, date, amount, pay) VALUES (:name, :date, :amount,:pay)");
    $smt->bindParam(":name", $name);
    $smt->bindParam(":date", $date);
    $smt->bindParam(":amount", $amount);
    $smt->bindParam(":pay", $pay);

    $smt->execute();
    $db->close();

    header("Location: ../index.php");
    exit();
}
