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

$selectSchedulesQuery = "
    SELECT s.schedule_id, s.employee_id, e.full_name
    FROM schedules s
    JOIN employees e ON s.employee_id = e.employee_id
";

$scheduleStmt = $pdo->prepare($selectSchedulesQuery);
$scheduleStmt->execute();
$schedules = $scheduleStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
                <h2>Edit Schedules</h2>

                <!-- Form for editing schedules -->
                <form action="./includes/editschedules.php" method="post">
                    <div class="form-group">
                        <label for="schedule_id">Select Schedule:</label>
                        <select class="form-control" id="schedule_id" name="scheduleId" required>
                            <?php foreach ($schedules as $schedule): ?>
                                <option value="<?= $schedule['schedule_id']; ?>"><?= $schedule['employee_id']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="employee_id">Select Employee:</label>
                        <select class="form-control" id="employee_id" name="employeeId" required>
                            <?php foreach ($schedules as $schedule): ?>
                                <option value="<?= $schedule['employee_id']; ?>"><?= $schedule['full_name']; ?></option>
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

                    <button type="submit" class="btn btn-primary mt-3">Update Schedule</button>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; ?>
