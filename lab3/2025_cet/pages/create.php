<?php

session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

?>
<form action="../handlers/create_handler.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />

    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required>
    <br />

    <label for="date">Installation Date:</label>
    <input type="date" name="date" id="date" required>
    <br />

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" required>
    <br />

    <label for="type">Type</label>
    <select name="type" id="type">
        <option value="outside">outside</option>
        <option value="inside">inside</option>
    </select>
    <br />
    <button type="submit">Add Camera</button>
</form>