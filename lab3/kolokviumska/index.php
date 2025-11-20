<?php

session_start();

include "database/db_connection.php";
include "jwt_helper.php";

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

$db = connectDatabase();
$result =$db->query("SELECT * FROM expenses");

if(!$result){
    die("Database query failed");
}
?>

<div>
    <h1>Expenses List</h1>
    <a href="pages/add_expense_form.php">Add expense</a>

    <a href="handlers/auth/logout_handler.php">Logout</a>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>date</th>
        <th>amount</th>
        <th>pay</th>
    </tr>
    </thead>

    <tbody>
    <?php if ($result): ?>
    <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>

        <tr>
            <td><?php echo htmlspecialchars($row['ID'])?></td>
            <td><?php echo htmlspecialchars($row['name'])?></td>
            <td><?php echo htmlspecialchars($row['date'])?></td>
            <td><?php echo htmlspecialchars($row['amount'])?></td>
            <td><?php echo htmlspecialchars($row['pay'])?></td>

            <td>
                <?php if ($row["amount"] <= 100): ?>
                <form action="handlers/delete_handler.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['ID'];?>">
                    <button type="submit">Delete</button>
                </form>
                <?php endif;?>

                <form action="pages/update_expense_form.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $row['ID'];?>">
                    <button type="submit">Update</button>
                </form>
            </td>

        </tr>

    <?php endwhile; ?>

    <?php endif; ?>

    </tbody>

</table>

