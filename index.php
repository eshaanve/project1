<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User CRUD App</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 50px 0 20px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        header h1 {
            margin: 0;
            font-size: 3rem;
            letter-spacing: 1px;
        }

        nav {
            text-align: center;
            margin: 40px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: inline-flex;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            font-weight: 600;
            padding: 12px 25px;
            background-color: #ffffff;
            color: #3498db;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #3498db;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <header>
        <h1>User CRUD App</h1>
    </header>

    <nav>
        <ul>
            <li><a href="register.php">Register User</a></li>
            <li><a href="read.php">Read Users</a></li>
            <li><a href="update.php">Update User</a></li>
            <li><a href="delete.php">Delete User</a></li>
        </ul>
    </nav>

</body>
</html>
