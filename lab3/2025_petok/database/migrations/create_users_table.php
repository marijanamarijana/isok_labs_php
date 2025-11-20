<?php
include "../db_connection.php";

$db = connectDatabase();

$qry = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    username TEXT NOT NULL,
    password TEXT NOT NULL
);
SQL;

if ($db->exec($qry)){
    echo "Table created";
}
else{
    echo "Table not created";
}
$db->close();
