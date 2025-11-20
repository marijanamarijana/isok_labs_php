<?php
include "../database/db_connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $type = $_POST['type'];

    $db = connectDatabase();

    $smt = $db->prepare("UPDATE events SET name = :name, location = :location, date = :date, type = :type WHERE id = :id");
    $smt-> bindValue(':name', $name);
    $smt-> bindValue(':location', $location);
    $smt-> bindValue(':date', $date);
    $smt-> bindValue(':type', $type);
    $smt-> bindValue(':id', $id, SQLITE3_INTEGER);
    $smt->execute();


    $db->close();
    header("Location: ../index.php");
    exit();
}
else{
    echo "error updating event";
}