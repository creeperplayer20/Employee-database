<div class="popup" id="add-dep-popup">
    <section class="popup-body">
        <h3>Add Department</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('add-dep-popup')">&times;</span>
        </div>

        <form action="server.php" method="post" name="departmentForm" onsubmit="return validateDepartmentForm();">

            <div class="form-control">
                <label for="departmentName">Department name</label><br>
                <input type="text" name="departmentName" id="departmentName" placeholder="Department name"
                    onblur="isDepartmentNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="abbreviation">Abbreviation</label><br>
                <input type="text" name="abbreviation" id="abbreviation" placeholder="Abbreviation"
                    onblur="isAbbreviationInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="city">City</label><br>
                <input type="text" name="city" id="city" placeholder="City" onblur="isCityInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="color">Color</label><br>
                <input type="color" name="color" id="color" placeholder="Color" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <input type="submit" name="addDepartmentPopup" value="Add Department">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="edit-dep-popup">
    <section class="popup-body">
        <h3>Edit Department</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('edit-dep-popup')">&times;</span>
        </div>

        <form action="server.php" method="post" name="departmentForm" >     
            <div class="form-control">
                <label for="departmentName">Department name</label><br>
                <input type="text" name="departmentName" id="departmentName" placeholder="Department name"
                    onblur="isDepartmentNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="abbreviation">Abbreviation</label><br>
                <input type="text" name="abbreviation" id="abbreviation" placeholder="Abbreviation"
                    onblur="isAbbreviationInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="city">City</label><br>
                <input type="text" name="city" id="city" placeholder="City" onblur="isCityInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="color">Color</label><br>
                <input type="color" name="color" id="color" placeholder="Color" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <input type="submit" name="editDepartmentPopup" value="Edit Department">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="add-emp-popup">
    <section class="popup-body">
        <h3>Add Employee</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('add-emp-popup')">&times;</span>
        </div>

        <form action="server.php" method="post" name="employeeForm" onsubmit="return validateEmployeeForm();">

            <div class="form-control">
                <label for="firstName">First Name</label><br>
                <input type="text" name="firstName" id="firstName" placeholder="First Name"
                    onblur="isFirstNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="lastName">Last Name</label><br>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                    onblur="isLastNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="entryDate">Entry Date</label><br>
                <input type="date" name="entryDate" id="entryDate" placeholder="Entry Date" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="department">Department(s)</label><br>
                <select name="id_dep[]" id="selectDepartment" multiple required>
                    <?php
                        $id_man = $_COOKIE['id_man'];
                        $selectSQL = "SELECT * FROM department WHERE id_man = $id_man";
                        $result = $connect->query($selectSQL);
                        
                        while ($row = $result->fetch_object()) {
                            echo "<option value='$row->id_dep'>$row->departmentName</option>";
                        }
                    ?>
                </select>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <input type="submit" name="addEmployeePopup" value="Add Employee">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="edit-emp-popup">
    <section class="popup-body">
        <h3>Edit Employee</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('edit-emp-popup')">&times;</span>
        </div>

        <form action="server.php" method="post" name="employeeForm" onsubmit="return validateEmployeeForm();">

            <div class="form-control">
                <label for="firstName">First Name</label><br>
                <input type="text" name="firstName" id="firstName" placeholder="First Name"
                    onblur="isFirstNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="lastName">Last Name</label><br>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                    onblur="isLastNameInputValid(this)" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="entryDate">Entry Date</label><br>
                <input type="date" name="entryDate" id="entryDate" placeholder="Entry Date" required>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <label for="department">Department(s)</label><br>
                <select name="id_dep[]" id="selectDepartment" multiple required>
                    <?php
                        $id_man = $_COOKIE['id_man'];
                        $selectSQL = "SELECT * FROM department WHERE id_man = $id_man";
                        $result = $connect->query($selectSQL);
                        
                        while ($row = $result->fetch_object()) {
                            echo "<option value='$row->id_dep'>$row->departmentName</option>";
                        }
                    ?>
                </select>
                <span class="error-text">Field is required!</span>
            </div>

            <div class="form-control">
                <input type="submit" name="editEmployeePopup" value="Edit Employee">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="info-emp-popup">
    <section class="popup-body">
        <h3>Employee Info</h3>

        <form action="server.php" method="post">
            <select multiple>
                <option>[ID] Department name (abbreviation) | City | Employee entry date</option>
                <?php
                    $id_emp = $_SESSION['id_emp'];
                    if(isset($id_emp)) {
                        $selectSQL = "SELECT department.*, employee.* FROM department INNER JOIN employee_department ON department.id_dep = employee_department.id_dep JOIN employee USING (id_emp) WHERE employee_department.id_emp = $id_emp;";
                        $result = $connect->query($selectSQL);

                        while ($row = $result->fetch_object()) {
                            echo "<option style='background-color: $row->color;' value='$row->id_dep'>[$row->id_dep] $row->departmentName ($row->abbreviation) | $row->city | $row->entryDate</option>";
                        }
                    }
                ?>
            </select>
            <div class="form-control">
                <input type="submit" name="hideEmpInfo" value="Close">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="info-dep-popup">
    <section class="popup-body">
        <h3>Department Info</h3>

        <form action="server.php" method="post">
            <div class="form-control">
                <select multiple>
                    <?php
                        $id_dep = $_SESSION['id_dep'];
                        if(isset($id_dep)) {
                            $selectSQL = "SELECT employee.* FROM employee INNER JOIN employee_department ON employee.id_emp = employee_department.id_emp WHERE employee_department.id_dep = $id_dep;";
                            $result = $connect->query($selectSQL);
                        
                            while ($row = $result->fetch_object()) {
                                echo "<option value='$row->id_emp'>$row->firstname $row->lastname</option>";
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-control">
                <input type="submit" name="hideDepInfo" value="Close">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="filter-emp-popup">
    <section class="popup-body">
        <h3>Filter by</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('filter-emp-popup')">&times;</span>
        </div>

        <form action="server.php" method="post">
            <div class="form-control">
                <label for="department">Filter by</label><br>
                <select name="filterBy[]" id="filterby" multiple>
                    <?php
                        $id_man = $_COOKIE['id_man'];
                        $selectSQL = "SELECT * FROM department WHERE id_man = $id_man";
                        $result = $connect->query($selectSQL);
                        
                        while ($row = $result->fetch_object()) {
                            echo "<option value='$row->id_dep'>$row->departmentName</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-control">
                <input type="submit" name="filterEmployees" value="Filter">
                <input type="submit" name="resetFilter" value="Reset">
            </div>
        </form>
    </section>
</div>

<script src="../js/checkDepartmentForm.js"></script>
<script src="../js/checkEmployeeForm.js"></script>