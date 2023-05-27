<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        section {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->role === 'user') {
            echo '<header>
                <h1>Welcome, ' . $_SESSION['user']->name . '!</h1>
                <nav>
                    <a href="../change_password.php">Change Password</a>
                    <a href="../logout.php">Logout</a>
                </nav>
            </header>';
        } else {
            header("Location: http://localhost/Frontend/login.php");
            die();
        }
    } else {
        header("Location: http://localhost/Frontend/login.php");
        die();
    }
    ?>



    <footer>
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </footer>
</body>
</html>