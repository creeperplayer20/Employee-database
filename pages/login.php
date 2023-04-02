<?php
    include "connection.php";

    if(isset($_COOKIE["isLogged"]) && $_COOKIE["isLogged"] == true)
        header("Location: dashboard.php") and exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/x-icon" href="../images/employeester-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../images/employeester-logo.png">
    <title>Employeester • Login</title>
</head>
<body>

    <section class="login-wrapper">
        <h3>Login</h3>
        <form action="server.php" method="post" name="loginForm" onsubmit="return validateLoginForm();">

            <div class="form-control">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="creepha@example.net" onblur="isEmailInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="********" onblur="isPasswordInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

            <div>
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </section>

    <script src="../js/checkLoginForm.js"></script>
</body>
</html>