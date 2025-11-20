<?php

include "../db_connection.php";

$db = connectDatabase();

$smt = $db->prepare("CREATE TABLE IF NOT EXISTS expenses (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    date DATE NOT NULL,
    amount FLOAT NOT NULL,
    pay TEXT NOT NULL
);");

if ($smt->execute()) {
    echo "Table created";
}
else {
    echo "Error creating table";
}

$db->close();