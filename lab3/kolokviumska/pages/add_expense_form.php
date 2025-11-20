<?php
session_start();

include "../jwt_helper.php";

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}
?>

<form action="../handlers/create_handler.php" method="post">

    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="date">Date</label>
    <input type="date" name="date" id="date" required>

    <label for="amount">Amount</label>
    <input type="number" name="amount" id="amount" required>

    <select name="pay" id="pay">
        <option value="cash">cash</option>
        <option value="card">card</option>
    </select>

    <button type="submit"> Add expense </button>
</form>
