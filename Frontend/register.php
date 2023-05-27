<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <label>Email:</label>
            <input type="text" name="email" required />

            <label>Name:</label>
            <input type="text" name="name" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />

            <label for="password">Password Confirmation:</label>
            <input type="password" name="conpassword" required />

            <input type="submit" name="register" value="Create Account" /><br /><br />
            <a class="link" href="login.php">
                <span>Sign in</span>
            </a>
        </form>
    </div>
</body>

</html>

<?php
$user_name = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=project;", $user_name, $password);

if (isset($_POST['register'])) {
    // Validate form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];

    $errors = array(); // Array to store validation errors

    // Validate name
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    // Validate email
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password should be at least 6 characters long.';
    }

    // Validate password confirmation
    if (empty($conpassword)) {
        $errors[] = 'Password confirmation is required.';
    } elseif ($password !== $conpassword) {
        $errors[] = 'Password and confirmation do not match.';
    }

    // If there are no validation errors, proceed with registration
    if (empty($errors)) {
        // Check if the email is already registered
        $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
        $checkEmail->bindParam("EMAIL", $email);
        $checkEmail->execute();
        if ($checkEmail->rowCount() > 0) {
            $errors[] = 'This account is already registered.';
        } else {
            // Hash the password using MD5
            $hashedPassword = md5($password);

            // Insert the user into the database
            $addUser = $database->prepare("INSERT INTO users(NAME,EMAIL,PASSWORD,ROLE) VALUE(:NAME,:EMAIL,:PASSWORD,'user')");
            $addUser->bindParam('NAME', $name);
            $addUser->bindParam('EMAIL', $email);
            $addUser->bindParam('PASSWORD', $hashedPassword);
            if ($addUser->execute()) {
                echo 'Account created successfully.';
            } else {
                $errors[] = 'Failed to create an account. Please try again later.';
            }
        }
    }

    // Display validation errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>