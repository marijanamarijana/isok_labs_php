<?php
session_start();

include "../database/db_connection.php";
include "../jwt_helper.php";

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

$result = null;

if(isset($_GET['id'])){
    $db = connectDatabase();
    $id = $_GET['id'];

    $smt = $db->prepare("SELECT * FROM expenses WHERE ID = :ID");
    $smt->bindParam(":ID", $id);
    $query = $smt->execute();

    $result = $query->fetchArray(SQLITE3_ASSOC);
}

?>

<?php if ($result):?>

<form action="../handlers/update_handler.php" method="post">

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($result["ID"]);?>">

    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($result["name"]);?>" required>

    <label for="date">Date</label>
    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($result["date"]);?>" required>

    <label for="amount">Amount</label>
    <input type="number" name="amount" id="amount" value="<?php echo htmlspecialchars($result["amount"]);?>" required>

    <select name="pay" id="pay">
        <option <?php echo htmlspecialchars($result["pay"]) === "cash" ? "selected=true" : "";?> value="cash">cash</option>
        <option <?php echo htmlspecialchars($result["pay"]) === "card" ? "selected=true" : "" ?> value="card">card</option>
    </select>

    <button type="submit"> Edit expense </button>
</form>

<?php endif;?>
