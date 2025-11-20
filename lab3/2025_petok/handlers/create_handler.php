<?php


include "../database/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? "";
    $location = $_POST['location'] ?? "";
    $date = $_POST['date'] ?? "";
    $type = $_POST['type'] ?? "";

    $db = connectDatabase();

    $smt = $db->prepare("INSERT INTO events (name, location, date, type) VALUES (:name, :location, :date, :type)");
    $smt->bindValue(':name', $name, SQLITE3_TEXT);
    $smt->bindValue(':location', $location, SQLITE3_TEXT);
    $smt->bindValue(':date', $date, SQLITE3_TEXT);
    $smt->bindValue(':type', $type, SQLITE3_TEXT);


    if($smt->execute()){
        $db->close();
        header("Location: ../index.php");
        exit();
    }
    else{
        echo $db->lastErrorMsg();
    }


} else {
    echo "error adding event";
}