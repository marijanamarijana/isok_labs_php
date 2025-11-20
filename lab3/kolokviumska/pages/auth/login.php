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
        <h1>Login</h1>

        <form action="../../handlers/auth/login_handler.php" method="post">
            <label for="username">Username</label>
            <input value="text" name="username" id="username" required>

            <label for="password">Password</label>
            <input value="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>

        <a href="register.php"> Register here !</a>
    </div><?php
