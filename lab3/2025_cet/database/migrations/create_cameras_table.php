<?php

include '../db_connection.php';

$db = connectDatabase();

$query = "CREATE TABLE IF NOT EXISTS cameras(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    location TEXT NOT NULL,
    date DATE NOT NULL,
    price FLOAT NOT NULL,
    type TEXT NOT NULL
);";

$db->exec($query);