<?php
session_start();
?>

<?php
    include "connection.php";

    if(!(isset($_COOKIE["isLogged"]) && $_COOKIE["isLogged"] == true))
        header("Location: login.php") and exit;

    require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="icon" type="image/x-icon" href="../images/employeester-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../images/employeester-logo.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Employeester • Dashboard</title>
</head>
<body>

    <script src="../js/popup.js"></script>

    <div class="dashboard-wrapper">
        <div class="dashboard-holder">
            <h3>Dashboard</h3>
            <p>👋 Welcome back, <?php echo $_COOKIE['firstname'] . " " . $_COOKIE['lastname'] . "!"; ?></p>
            <div class="form-control">
                <form action="server.php" method="post">
                    <input type="submit" name="logout" value="Logout">
                </form>
            </div>
        </div>
    <br>
        <div class="dashboard-holder">
            <h3>Departments</h3>
            <p>👨‍💼 Here you can add, edit, delete and view your departments.</p>
            <div class="form-control">
                <input type="submit" name="addDepartment" value="Add Department" onclick="showPopup('add-dep-popup')"><br>
            </div>
            <div class="table-wrapper">
                <?php
                    if(!getDepartmentsCount($connect) <= 0) {
                        echo "<table>";

                        echo "                        
                        <tr>
                            <th>Department ID</th>
                            <th>Department name</th>
                            <th>Abbreviation</th>
                            <th>City</th>
                            <th>Color</th>
                            <th>Employee count</th>
                            <th>Actions</th>
                        </tr>";

                        getDepartments($connect);

                        echo "</table>";
                    }
                ?>
            </div>
        </div>
    <br>
        <div class="dashboard-holder">
            <h3>Employees</h3>
            <p>👷 Here you can add, edit, delete and view your employees.</p>
            <div class="form-control">
                <input type="submit" name="addEmployee" value="Add Employee" onclick="showPopup('add-emp-popup')"><br>
                <input type="submit" name="filter" value="Filter" onclick="showPopup('filter-emp-popup')"><br>
            </div>
            <div class="table-wrapper">
                <?php
                    if(!getEmployeesCount($connect) <= 0) {
                        echo "<table>";

                        echo "                        
                        <tr>
                            <th>Employee ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Department</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>";

                        getEmployees($connect);

                        echo "</table>";
                    }
                ?>
            </div>
        </div>
    </div>             
</body>
</html>

<?php
    include 'popups.php';
?>

<?php
    if (isset($_GET['empInfo']) && $_GET['empInfo'] == 'true' && isset($_GET['id_emp'])) {
        echo "<script>showPopup('info-emp-popup');</script>";
        return;
    } else if(isset($_GET['id_dep']))
        if(isset($_GET['depInfo']) && $_GET['depInfo'] == 'true')
            echo "<script>showPopup('info-dep-popup');</script>";
        else 
            echo "<script>showPopup('edit-dep-popup');</script>";
        else if(isset($_GET['id_emp'])) 
            echo "<script>showPopup('edit-emp-popup');</script>";
?>