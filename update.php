<?php
require_once "db.php";

function update_record($id, $name, $email) {
    global $conn;
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    return mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    if (update_record($id, $name, $email)) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update User</h1>
    <a href="index.php">Home</a> |
    <a href="read.php">View Users</a>
    <br><br>

    <form method="POST">
        User ID: <input type="number" name="id" required><br><br>
        New Name: <input type="text" name="name" required><br><br>
        New Email: <input type="email" name="email" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
