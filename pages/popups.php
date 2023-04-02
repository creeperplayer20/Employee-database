<script src="../js/checkDepartmentForm.js"></script>
<script src="../js/checkEmployeeForm.js"></script>

<div class="popup" id="dep-popup">
    <section class="popup-body">
        <h3>Add Department</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('dep-popup')">&times;</span>
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
                <input type="submit" name="addDepartment" value="Add Department">
            </div>
        </form>
    </section>
</div>

<div class="popup" id="emp-popup">
    <section class="popup-body">
        <h3>Add Employee</h3>

        <div class="popup-close">
            <span class="close" onclick="hidePopup('emp-popup')">&times;</span>
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
                <label for="department">Department</label><br>
                <select name="id_dep[]" id="selectDepartment" multiple>
                    <?php
                        $id_man = $_SESSION['id_man'];
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
                <input type="submit" name="addEmployee" value="Add Employee">
            </div>
        </form>
    </section>
</div>