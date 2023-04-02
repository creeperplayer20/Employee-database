<?php

function getDepartmentsCount($connect){
    $sql = "SELECT COUNT(id_dep) AS dep_count FROM department;";
    $result = $connect->query($sql);
    $row = $result->fetch_object();
    return $row->dep_count;
}

function getDepartments($connect){
    $sql = "SELECT dep.id_dep, dep.abbreviation, dep.city, dep.color, dep.departmentName, COUNT(employee_department.id_emp) AS emp_count FROM department AS dep LEFT JOIN employee_department USING (id_dep) GROUP BY dep.id_dep, dep.departmentName ORDER BY dep.id_dep ASC;";
    $result = $connect->query($sql);
    while($row = $result->fetch_object()){
        echo " 
        <tr> 
            <form action='server.php' method='post'>
                <input type='hidden' id='id_dep' name='id_dep' value='$row->id_dep'>
                <td> <p>$row->departmentName</p> </td>
                <td> <p>$row->abbreviation</p> </td>
                <td> <p>$row->city</p> </td>
                <td style='background-color: $row->color;'> <p>$row->color</p> </td>
                <td> <p>$row->emp_count</p> </td>
                <td> 
                    <input type='submit' name='edit' value='Edit'>
                    <input type='submit' name='informaiton' value='Information'>
                    <input type='submit' name='deleteDepartment' value='Delete'>
                </td>
            </form>
        </tr>";
    }
}

function getEmployeesCount($connect){
    $sql = "SELECT COUNT(id_emp) AS emp_count FROM employee;";
    $result = $connect->query($sql);
    $row = $result->fetch_object();
    return $row->emp_count;
}

function getEmployees($connect) {
    $sql = "SELECT emp.id_emp, emp.firstname, emp.lastname, dep.departmentName, dep.color FROM employee AS emp LEFT JOIN employee_department AS ed ON emp.id_emp = ed.id_emp LEFT JOIN department AS dep ON ed.id_dep = dep.id_dep ORDER BY emp.id_emp ASC;";
    $result = $connect->query($sql);

    while($row = $result->fetch_object()){
        echo " 
        <tr> 
            <form action='server.php' method='post'>
                <input type='hidden' id='id_emp' name='id_emp' value='$row->id_emp'>
                <td> <p>$row->id_emp</p> </td>
                <td> <p>$row->firstname</p> </td>
                <td> <p>$row->lastname</p> </td>
                <td style='background-color: $row->color;'> <p>$row->color</p> </td>
                <td> <p>$row->departmentName</p> </td>
                <td> 
                    <input type='submit' name='edit' value='Edit'>
                    <input type='submit' name='informaiton' value='Information'>
                    <input type='submit' name='deleteEmployee' value='Delete'>
                </td>
            </form>
        </tr>";
    }
}
?>