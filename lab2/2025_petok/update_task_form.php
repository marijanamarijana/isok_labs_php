<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM tasks_table WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $task = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid task ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
</head>
<body>
<h1>Update Task</h1>

<?php if ($task): ?>
    <form action="update_task.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required><br><br>

        <label for="priority">Priority:</label>
        <select name="priority" required>
            <option value="Low"    <?php echo $task['priority'] === 'Low' ? 'selected' : ''; ?>>Low</option>
            <option value="Medium" <?php echo $task['priority'] === 'Medium' ? 'selected' : ''; ?>>Medium</option>
            <option value="Done"   <?php echo $task['priority'] === 'Done' ? 'selected' : ''; ?>>Done</option>
        </select>
        <br><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending" <?php echo $task['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Done"    <?php echo $task['status'] === 'Done' ? 'selected' : ''; ?>>Done</option>
        </select>
        <br><br>

        <button type="submit">Update Task</button>
    </form>

<?php else: ?>
    <p>Task not found.</p>
<?php endif; ?>

</body>
</html>