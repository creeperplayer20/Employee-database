<?php

function getDepartmentsCount($connect){
    $managerID = $_COOKIE['id_man'];

    $sql = "SELECT COUNT(id_dep) AS dep_count FROM department LEFT JOIN manager ON department.id_man = manager.id_man WHERE manager.id_man = $managerID;";
    $result = $connect->query($sql);

    if(!$result->num_rows > 0) return 0;

    $row = $result->fetch_object();
    return $row->dep_count;
}

function getDepartments($connect){
    $managerID = $_COOKIE['id_man'];
    $sql = "SELECT *, COUNT(employee_department.id_emp) AS emp_count FROM department AS dep LEFT JOIN employee_department USING (id_dep) LEFT JOIN manager ON dep.id_man = $managerID WHERE manager.id_man = $managerID GROUP BY dep.id_dep, dep.departmentName ORDER BY dep.id_dep ASC;";
    $result = $connect->query($sql);
    while($row = $result->fetch_object()){
        echo " 
        <tr> 
            <form action='server.php' method='post'>
                <input type='hidden' id='id_dep' name='id_dep' value='$row->id_dep'>
                <td> <p>$row->id_dep</p> </td>
                <td> <p>$row->departmentName</p> </td>
                <td> <p>$row->abbreviation</p> </td>
                <td> <p>$row->city</p> </td>
                <td style='background-color: $row->color;'> <p>$row->color</p> </td>
                <td> <p>$row->emp_count</p> </td>
                <td> 
                    <input type='submit' name='getIDDepartment' value='Edit Department'>
                    <input type='submit' name='showDepInfo' value='Information'>
                    <input type='submit' name='deleteDepartment' value='Delete'>
                </td>
            </form>
        </tr>";
    }
}

function getEmployeesCount($connect){
    $managerID = $_COOKIE['id_man'];

    $sql = "SELECT COUNT(employee_department.id_emp) AS emp_count FROM employee_department LEFT JOIN department ON employee_department.id_dep = department.id_dep LEFT JOIN manager ON department.id_man = manager.id_man WHERE manager.id_man = $managerID;";
    $result = $connect->query($sql);

    if(!$result->num_rows > 0) return 0;

    $row = $result->fetch_object();
    return $row->emp_count;
}

function getEmployees($connect) {
    $managerID = $_COOKIE['id_man'];
    $filterBy = isset($_SESSION['filterBy']) ? $_SESSION['filterBy'] : array();
    
    $sql = "SELECT emp.id_emp, emp.firstname, emp.lastname, dep.departmentName, dep.color FROM employee AS emp LEFT JOIN employee_department AS ed ON emp.id_emp = ed.id_emp LEFT JOIN department AS dep ON ed.id_dep = dep.id_dep LEFT JOIN manager ON dep.id_man = $managerID WHERE manager.id_man = $managerID";
    
    if (!empty($filterBy)) {
        $filterByStr = implode(",", $filterBy);
        $sql .= " AND dep.id_dep IN ($filterByStr)";
    }
    
    $sql .= " ORDER BY emp.id_emp ASC;";
    
    $result = $connect->query($sql);

    while($row = $result->fetch_object()){
        echo " 
        <tr> 
            <form action='server.php' method='post'>
                <input type='hidden' id='id_emp' name='id_emp' value='$row->id_emp'>
                <td> <p>$row->id_emp</p> </td>
                <td> <p>$row->firstname</p> </td>
                <td> <p>$row->lastname</p> </td>
                <td> <p>$row->departmentName</p> </td>
                <td style='background-color: $row->color;'> <p>$row->color</p> </td>
                <td> 
                    <input type='submit' name='getIDEmployee' value='Edit Employee'>
                    <input type='submit' name='showEmpInfo' value='Information'>
                    <input type='submit' name='deleteEmployee' value='Delete'>
                </td>
            </form>
        </tr>";
    }
}
?>