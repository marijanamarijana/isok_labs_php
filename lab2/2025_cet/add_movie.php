<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $year = (int)($_POST['year'] ?? 0);

    if (empty($title) || empty($genre) || $year <= 0) {
        echo "Please fill in all required fields correctly.";
        exit;
    }
    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO movies (title, genre, year) VALUES (:title, :genre, :year)");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error adding student: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method. Please submit the form to add a movie.";
}
