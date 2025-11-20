<?php

include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("DELETE FROM cameras WHERE id = :id AND (julianday('now') - julianday(date)) <= 7");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    $db->close();

    header("Location: ../index.php");
    exit();
} else {
    echo "Invalid request.";
}
