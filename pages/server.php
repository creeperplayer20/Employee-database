<?php
    include "connection.php";

    if(isset($_POST['register'])) {
        $InputFirstName = $_POST['firstname'];
        $InputLasttName = $_POST['lastname'];
        $InputEmail = $_POST['email'];
        $InputPassword = $_POST['password'];
        $InputCompanyName = $_POST['companyName'];

        if(filter_var($InputEmail, FILTER_VALIDATE_EMAIL)) {
            $hashedPassword = password_hash($InputPassword, PASSWORD_DEFAULT);
            
            $insertSQL = "INSERT INTO manager(firstname, lastname, email, password, companyName) VALUES ('$InputFirstName', '$InputLasttName', '$InputEmail', '$hashedPassword', '$InputCompanyName');";

            if($connect->query($insertSQL) === TRUE) {
                session_destroy();
                header('Location: login.php') and die();
            } 
        }
    }

    if(isset($_POST['login'])) {
        $InputEmail = $_POST['email'];
        $InputPassword = $_POST['password'];

        $selectSQL = "SELECT * FROM manager WHERE email = '$InputEmail';";
        $result = $connect->query($selectSQL);

        if($result->num_rows > 0) {
            $user = $result->fetch_object();
            if(password_verify($InputPassword, $user->password)) {
                setcookie("isLogged", true, time() + 60 * 60 * 24, "/", "", 0, 1);
                setcookie('id_man', $user->id_man, time() + 60 * 60 * 24, '/', "", 0, 1);
                setcookie('firstname', $user->firstname, time() + 60 * 60 * 24, '/', "", 0, 1);
                setcookie('lastname', $user->lastname, time() + 60 * 60 * 24, '/', "", 0, 1);
                setcookie('email', $user->email, time() + 60 * 60 * 24, '/', "", 0, 1);
                setcookie('password', $user->password, time() + 60 * 60 * 24, '/', "", 0, 1);
                setcookie('companyName', $user->companyName, time() + 60 * 60 * 24, '/', "", 0, 1);

                header('Location: dashboard.php') and die();
            }
        }
    }

    if(isset($_POST['logout'])) {
        foreach($_COOKIE as $name => $value) {
            setcookie($name, '', time() - 60 * 60 * 24, '/', "", 0, 1);
        }

        header('Location: login.php');

        ob_flush();
        flush();

        die();
    }

    if(isset($_POST['addDepartment'])) {
        $InputDepartmentName = $_POST['departmentName'];
        $InputAbbreviation = strtoupper($_POST['abbreviation']);
        $InputCity = $_POST['city'];
        $InputColor = $_POST['color'];

        $ManagerEmail = $_COOKIE['email'];

        $selectSQLManager = "SELECT manager.id_man FROM manager WHERE email = '$ManagerEmail';";
        $result = $connect->query($selectSQLManager);
        $ManagerID;

        if($result->num_rows > 0) {
            $user = $result->fetch_object();
            $ManagerID = $user->id_man;
        }

        $insertSQL = "INSERT INTO department(departmentName, abbreviation, city, color, id_man) VALUES ('$InputDepartmentName', '$InputAbbreviation', '$InputCity', '$InputColor', '$ManagerID');";

        if($connect->query($insertSQL) === TRUE)
            header('Location: dashboard.php') and die();
    }

    if(isset($_POST['deleteDepartment'])) {
        $DepartmentID = $_POST['id_dep'];

        $deleteEmployeeDepartmentSQL = "DELETE FROM employee_department WHERE id_dep = $DepartmentID;";
        $deleteDepartmentSQL = "DELETE FROM department WHERE id_dep = $DepartmentID;";

        if($connect->query($deleteEmployeeDepartmentSQL) === TRUE && $connect->query($deleteDepartmentSQL) === TRUE)
            header('Location: dashboard.php') and die();
    }

    if (isset($_POST['addEmployee'])) {
        $InputFirstName = $_POST['firstName'];
        $InputLastName = $_POST['lastName'];
        $InputEntryDate = $_POST['entryDate'];
        $InputDepartmentIDs = implode(",", $_POST['id_dep']);
    
        $insertSQL = "INSERT INTO employee (firstname, lastname, entryDate) VALUES ('$InputFirstName', '$InputLastName', '$InputEntryDate')";
    
        if ($connect->query($insertSQL) === TRUE) {
            $last_id = $connect->insert_id;
            $departmentIDs = explode(",", $InputDepartmentIDs);

            foreach ($departmentIDs as $id_dep) {
                $insertSQL = "INSERT INTO employee_department (id_emp, id_dep) VALUES ('$last_id', '$id_dep')";
                $connect->query($insertSQL);
            }

            header('Location: dashboard.php') and die();
        }
    }

    if(isset($_POST['deleteEmployee'])) {
        $EmployeeID = $_POST['id_emp'];

        $deleteEmployeeDepartmentSQL = "DELETE FROM employee_department WHERE id_emp = $EmployeeID;";
        $deleteEmployeeSQL = "DELETE FROM employee WHERE id_emp = $EmployeeID;";

        if($connect->query($deleteEmployeeDepartmentSQL) === TRUE && $connect->query($deleteEmployeeSQL) === TRUE)
            header('Location: dashboard.php') and die();
    }

    header("Location: register.php") and die();
?>