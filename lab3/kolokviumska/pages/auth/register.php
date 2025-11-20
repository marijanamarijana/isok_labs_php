<?php
session_start();
include "../../database/db_connection.php";
require "../../jwt_helper.php";

if (isset($_SESSION['jwt']) && decodeJWT($_SESSION['jwt'])) {
    header("Location: ../../index.php");
    exit;
}
?>
<div>
    <h1>Register</h1>

    <form action="../../handlers/auth/register_handler.php" method="post">
        <label for="username">Username</label>
        <input value="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input value="password" name="password" id="password" required>

        <button type="submit">Register</button>
    </form>

    <a href="login.php"> Login here !</a>
</div>