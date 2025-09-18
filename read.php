<?php
require_once "db.php";

function read_records() {
    global $conn;
    $sql = "SELECT * FROM users";
    return mysqli_query($conn, $sql);
}

$result = read_records();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Read Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>User List</h1>
    <a href="index.php">Home</a> |
    <a href="create.php">Add User</a>
    <br><br>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
</body>
</html>
