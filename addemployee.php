<?php 
 include "./header.php";
?>
<?php
 include_once "./sidebar.php";
?>
<div class="container mt-5">
    <h2>Add Employees</h2>
    <form action="process_add_employee.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="full_name">Full Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group col-md-6">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="hire_date">Hire Date:</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            <div class="form-group col-md-6">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="form-group col-md-6">
                <label for="job_title">Job Title:</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
    </form>
</div>
<?php
  include "./footer.php"
 ?>
