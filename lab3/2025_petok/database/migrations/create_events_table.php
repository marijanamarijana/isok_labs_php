<?php
include "../db_connection.php";

$db = connectDatabase();

$qry = <<<SQL
CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    location TEXT NOT NULL,
    date DATE NOT NULL,
    type TEXT NOT NULL
);
SQL;

if ($db->exec($qry)){
    echo "Table created";
}
else{
    echo "Table not created";
}
$db->close();