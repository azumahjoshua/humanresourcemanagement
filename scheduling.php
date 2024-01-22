<?php
session_start();

// Include necessary header, footer, or other files
include_once './header.php';

// Your database connection code
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

// Assume you have a list of employees retrieved from the database
// Replace this with your actual database query
$stmt = $pdo->prepare("SELECT employee_id, full_name FROM employees");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
                <h2>Schedule Management</h2>
                <div class="mb-3">
                    <a href="./viewSchedules.php" class="btn btn-primary">View Schedules</a>
                </div>

                <div class="mb-3">
                    <a href="./createschedule.php" class="btn btn-success">Create Schedule</a>
                </div>

                <div class="mb-3">
                    <a href="./editschedules.php" class="btn btn-warning">Edit Schedules</a>
                </div>
                <div class="mb-3">
                    <a href="./deleteschedule.php" class="btn btn-warning">Delete Schedule</a>
                </div>
            </div>
        </main>
    </div>
</div>


<?php include "./footer.php"; ?>
