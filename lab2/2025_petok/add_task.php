<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $status = $_POST['status'] ?? '';

    if (empty($title) || empty($due_date) || empty($priority) || empty($status)) {
        echo "Please fill in all required fields correctly.";
        exit;
    }

    if (!in_array($priority, ["Low", "Medium", "High"])){
        echo is_string($priority);
        echo "Priority field can be ... ";
        exit;
    }

    if(!in_array($status, ["Pending", "Done"]))
    {
        echo is_string($status);
        echo "Status field can be ... ";
        exit;
    }

    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO tasks_table (title, due_date, priority, status) VALUES (:title, :due_date, :priority, :status)");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':due_date', $due_date, SQLITE3_TEXT);
    $stmt->bindValue(':priority', $priority, SQLITE3_TEXT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);


    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error adding task: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method. Please submit the form to add a task.";
}
