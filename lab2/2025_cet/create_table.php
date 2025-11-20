<?php
$db = new SQLite3(__DIR__ . '/database/movies_db.sqlite');

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS movies (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    genre TEXT UNIQUE NOT NULL,
    year INTEGER NOT NULL
);
SQL;

if ($db->exec($createTableQuery)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}

$db->close();
?>