<?php

session_start();
include "../database/db_connection.php";
include "../jwt_helper.php";

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["id"])){
    $id = intval($_POST["id"]);

    $name = $_POST["name"];
    $date = $_POST["date"];
    $amount = intval($_POST["amount"]);
    $pay = $_POST["pay"];

    $db = connectDatabase();
    $smt = $db->prepare("UPDATE expenses SET name = :name, date = :date, amount = :amount, pay = :pay WHERE ID = :ID");
    $smt->bindParam(":name", $name);
    $smt->bindParam(":date", $date);
    $smt->bindParam(":amount", $amount, SQLITE3_INTEGER);
    $smt->bindParam(":pay", $pay);
    $smt->bindParam(":ID", $id, SQLITE3_INTEGER);

    $smt->execute();
    $db->close();

    header("Location: ../index.php");
    exit();
}
