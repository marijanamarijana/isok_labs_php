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

    $db = connectDatabase();
    $smt = $db->prepare("DELETE FROM expenses WHERE ID = :ID AND amount <= 100");
    $smt->bindParam(":ID", $id, SQLITE3_INTEGER);

    $smt->execute();
    $db->close();

    header("Location: ../index.php");
    exit();
}