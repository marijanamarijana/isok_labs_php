<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
</head>
<body>
<form action="add_task.php" method="POST">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br />

    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date" id="due_date" required>
    <br />

    <label for="priority">Priority:</label>
    <select name="priority" id="priority" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="Done">Done</option>
    </select>
    <br />

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="Pending">Pending</option>
        <option value="Done">Done</option>
    </select>
    <br />

    <button type="submit">Add Task</button>
</form>
</body>
</html>