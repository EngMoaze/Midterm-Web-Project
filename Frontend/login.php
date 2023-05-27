<br>
<br>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="login" value="Login"><br><br>
            <a class="link" href="register.php">No Account :
                <span>Create Account</span>
            </a>
        </form>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>

<?php
if (isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email and password
    $errors = array();

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no validation errors, proceed with login
    if (empty($errors)) {
        // Establish database connection
        $user_name = "root";
        $db_password = "";
        $database = new PDO("mysql:host=localhost; dbname=project;", $user_name, $db_password);

        // Prepare and execute the login query with parameterized statements to prevent SQL injection
        $login = $database->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $login->bindParam(":email", $email);
        $login->bindParam(":password", md5($password));
        $login->execute();

        // Check if login credentials are valid
        if ($login->rowCount() == 1) {
            $user = $login->fetch(PDO::FETCH_OBJ);
            echo 'مرحباً ' . $user->name;

            // Store user data in session
            session_start();
            $_SESSION['email'] = $user->email;
            $_SESSION['password'] = $user->password;
            $_SESSION['user'] = $user;

            // Redirect based on user role
            if ($user->role == 'user') {
                $_SESSION['user'] = $user;
                header("Location: user/index.php");
                exit();
            } elseif ($user->role == 'admin') {
                $_SESSION['user'] = $user;
                header("Location: admin/index.php");
                exit();
            }
        } else {
            echo 'البريد الإلكتروني أو كلمة المرور غير صحيحة';
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>