<?php

include "../db_connection.php";

$db = connectDatabase();

$smt = $db->prepare("CREATE TABLE IF NOT EXISTS users(
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL
);");

if ($smt->execute()) {
    echo "Table created";
} else {
    echo "Error creating table";
}

$db->close();