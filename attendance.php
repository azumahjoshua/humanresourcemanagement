<?php
session_start();
include './header.php';
$host = "localhost";
$dbname = 'humanresourcemanagement';
$username = "root";
$password = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conncted sucessfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
$stmt = $pdo->prepare("SELECT employee_id, full_name FROM employees");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>
        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
                <h2>Employee Attendance</h2>

                <!-- Simple form for marking attendance -->
                <div class="form-group">
                    <label for="employee_id">Select Employee:</label>
                    <select class="form-control" id="employee_id" required>
                        <?php
                            foreach ($employees as $employee) {
                                echo "<option value='{$employee['employee_id']}'>{$employee['full_name']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <button class="btn btn-primary" onclick="recordAttendance('ClockIn')">Clock In</button>
                <button class="btn btn-danger" onclick="recordAttendance('ClockOut')">Clock Out</button>
            </div>
        </main>
    </div>
</div>
<?php
include "./footer.php"
?>