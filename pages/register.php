<?php
    session_start();
    include "connection.php";

    if(isset($_SESSION["isLogged"]) && $_SESSION["isLogged"] === true)
        header("Location: dashboard.php") and exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="icon" type="image/x-icon" href="../images/employeester-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../images/employeester-logo.png">
    <title>Employeester • Register</title>
</head>
<body>

    <section class="registration-wrapper">
        <h3>Register</h3>
        <form action="server.php" method="post" name="registrationForm" onsubmit="return validateRegistrationForm();">

            <div class="form-control">
                <label for="firstname">First name</label><br>
                <input type="text" name="firstname" id="firstname" placeholder="John" onblur="isNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="lastname">Last name</label><br>
                <input type="text" name="lastname" id="lastname" placeholder="Doe" onblur="isNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="********" onblur="isPasswordInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="confirmPassword">Confirm password</label><br>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="********" onblur="isPasswordConfirmVaild(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="creepha@example.net" onblur="isEmailInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="companyname">Name of the Company</label><br>
                <input type="text" name="companyName" id="companyName" placeholder="Fungus & Dungus" onblur="isCompanyNameValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div>
                <p>Aleady have an account? <a href="login.php">Login</a></p>
            </div>

            <div>
                <input type="submit" name="register" value="Sign Up">
            </div>
        </form>
    </section>

    <script src="../js/checkRegistrationForm.js"></script>
</body>
</html>