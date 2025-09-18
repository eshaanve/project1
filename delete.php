<?php
require_once "db.php";

function delete_record($id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id=$id";
    return mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];

    if (delete_record($id)) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Delete User</h1>
    <a href="index.php">Home</a> |
    <a href="read.php">View Users</a>
    <br><br>

    <form method="POST">
        User ID: <input type="number" name="id" required><br><br>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
