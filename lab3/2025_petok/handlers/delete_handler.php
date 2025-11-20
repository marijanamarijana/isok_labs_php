<?php
include "../database/db_connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    $id = intval($_POST['id']);

    $db = connectDatabase();

    $smt = $db->prepare("DELETE FROM events WHERE id = :id AND type = :type");
    $smt-> bindValue(':id', $id, SQLITE3_INTEGER);
    $smt-> bindValue(':type', "public", SQLITE3_TEXT);
    $smt->execute();

    $db->close();
    header("Location: ../index.php");
    exit();
}
else{
    echo "error deleting event";
}