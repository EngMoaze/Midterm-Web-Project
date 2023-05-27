<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process form data here
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate current password
    if (!validateCurrentPassword($currentPassword)) {
        $error = "Incorrect current password. Please try again.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New password and confirm password do not match. Please try again.";
    } else {
        // Perform your password change logic here
        // ...

        // Show success message
        $success = "Password changed successfully!";
    }
}

// Function to validate the current password (replace this with your own logic)
function validateCurrentPassword($currentPassword)
{
    // Retrieve the current password from your database or any other storage
    $storedPassword = "123456"; // Example only, replace with your stored password

    // Compare the provided password with the stored password
    if ($currentPassword === $storedPassword) {
        return true; // Password is correct
    } else {
        return false; // Password is incorrect
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
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

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Change Password</h1>
        <nav>
            <a href="admin/index.php">Admin Page</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <form action="change_password.php" method="post">
            <?php if (isset($error)) : ?>
                <div class="error" style="text-align: center;"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (isset($success)) : ?>
                <div class="success" style="text-align: center;"><?php echo $success; ?></div ?>
                </div>
            <?php endif; ?> <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="conpassword" name="confirm_password" required>

            <input type="submit" value="Change Password">
        </form>
    </section>
</body>

</html>