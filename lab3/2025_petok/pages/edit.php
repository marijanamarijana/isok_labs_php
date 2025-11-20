<?php

include "../database/db_connection.php";
require "../jwt_helper.php";

session_start();
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $db = connectDatabase();

    $smt = $db->prepare("SELECT * FROM events WHERE id = :id");
    $smt->bindParam(":id", $id, SQLITE3_INTEGER);
    $result = $smt->execute();
    $event = $result->fetchArray(SQLITE3_ASSOC);
}
?>

<?php if($event): ?>
    <form action = "../handlers/edit_handler.php" method = "POST" >
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']);?>">

    <label for="event-name" > Name:</label >
    <input type = "text" name = "name" id = "name" value="<?php echo htmlspecialchars($event['name']); ?>" required >
    <br>

    <label for="location" > Location:</label >
    <input type = "text" name = "location" id = "location" value="<?php echo htmlspecialchars($event['location']); ?>"  required >
    <br />

    <label for="date" > Date:</label >
    <input type = "date" name = "date" id = "date" value="<?php echo htmlspecialchars($event['date']); ?>"  required >
    <br />

    <label for="type" > Type</label >
    <select name = "type" id = "type" >
        <option <?php echo htmlspecialchars($event['type']) === "public" ? "selected=true" : ''; ?> value = "public" >public</option >
        <option <?php echo htmlspecialchars($event['type']) === "private" ? "selected=true" : ''; ?> value = "private" >private</option >
    </select >
    <br />

    <button type = "submit" > Add Event </button >
</form >
<?php endif; ?>