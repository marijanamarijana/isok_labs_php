<?php
include "../database/db_connection.php";


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $db = connectDatabase();
    $stmt = $db->prepare("SELECT * FROM cameras WHERE id= :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute();
    $camera = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
}
else{
    die("Invalid expense ID.");
}
?>

    <h1>Update Expense</h1>

<?php if ($camera): ?>
    <form action="../handlers/update_handler.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($camera['id']); ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($camera['name']); ?>" required>
        <br>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($camera['location']) ?>" required>
        <br />

        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($camera['date']); ?>" required>
        <br>

        <label for="amount">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($camera['price']); ?>" required>
        <br>

        <label for="type">Type</label>
        <select name="type" id="type">
            <option <?php echo htmlspecialchars($camera['type']) === 'inside' ? 'selected=true' : ''; ?> value="inside">inside</option>
            <option <?php echo htmlspecialchars($camera['type']) === 'outside' ? 'selected=true' : ''; ?> value="outside">outside</option>
        </select>
        <br/>
        <button type="submit">Update Camera</button>
    </form>
<?php else: ?>
    <p>Camera not found.</p>
<?php endif; ?>