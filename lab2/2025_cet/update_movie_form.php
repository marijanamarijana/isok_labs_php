<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM movies WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $student = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid movie ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Movie</title>
</head>
<body>
<h1>Update Movie</h1>

<?php if ($student): ?>
    <form action="update_movie.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($student['title']); ?>" required><br><br>

        <label for="email">Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($student['genre']); ?>" required><br><br>

        <label for="year">Year:</label>
        <input type="number" name="year" value="<?php echo htmlspecialchars($student['year']); ?>" required><br><br>

        <button type="submit">Update Movie</button>
    </form>
<?php else: ?>
    <p>Movie not found.</p>
<?php endif; ?>
</body>
</html>