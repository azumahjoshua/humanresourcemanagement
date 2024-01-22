<?php
session_start();
include "./header.php";

// Establish a database connection
$host = "localhost";
$dbname = 'humanresourcemanagement'; 
$username = "root";   
$password = "";    

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Fetch employees for dropdown
$employeeStmt = $pdo->prepare("SELECT employee_id, full_name FROM employees");
$employeeStmt->execute();
$employees = $employeeStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
                <h2>Create Schedule</h2>

                <!-- Form for creating schedules -->
                <form action="./includes/createschedule.php" method="post">
                    <div class="form-group">
                        <label for="employee_id">Select Employee:</label>
                        <select class="form-control" id="employee_id" name="employeeId" required>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= $employee['employee_id']; ?>"><?= $employee['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="working_hours">Working Hours:</label>
                        <input type="text" class="form-control" id="working_hours" name="working_hours" required>
                    </div>

                    <div class="form-group">
                        <label for="assigned_tasks">Assigned Tasks:</label>
                        <input type="text" class="form-control" id="assigned_tasks" name="assigned_tasks" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Create Schedule</button>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; ?>
