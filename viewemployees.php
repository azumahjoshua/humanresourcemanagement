<?php 
session_start();
include "./header.php";
$sql = "SELECT e.* 
        FROM employees e
        LEFT JOIN employee_roles er ON e.employee_id = er.employee_id
        LEFT JOIN roles r ON er.role_id = r.role_id
        WHERE r.role_name IS NULL OR r.role_name != 'admin'";

$stmt = $pdo->query($sql);
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
        <div class="row align-items-center">
                <h2>View Employees</h2>

                <!-- Display Employee Table -->
                <div class="table-responsive col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Date of Birth</th>
                                <th>Hire Date</th>
                                <th>Salary</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Address</th> <!-- Assuming you added an 'address' field -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>{$row['employee_id']}</td>";
                                echo "<td>{$row['username']}</td>";
                                echo "<td>{$row['full_name']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['phone_number']}</td>";
                                echo "<td>{$row['date_of_birth']}</td>";
                                echo "<td>{$row['hire_date']}</td>";
                                echo "<td>{$row['salary']}</td>";
                                echo "<td>{$row['department']}</td>";
                                echo "<td>{$row['job_title']}</td>";
                                echo "<td>{$row['address']}</td>"; // Assuming 'address' is a field in your database
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
<?php
  include "./footer.php"
 ?>
