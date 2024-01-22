<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    // echo "Conncted sucessfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}


// Fetch schedules from the database
$stmt = $pdo->prepare("
    SELECT e.employee_id, e.full_name, s.working_hours, s.assigned_tasks, s.created_at
    FROM employees e
    JOIN schedules s ON e.employee_id = s.employee_id
");
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
                <h2>View Schedules</h2>

                <!-- Display a list of schedules -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Working Hours</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedules as $schedule): ?>
                            <tr>
                                <td><?= $schedule['employee_id']; ?></td>
                                <td><?= $schedule['full_name']; ?></td>
                                <td><?= $schedule['working_hours']; ?></td>
                                <td><?= $schedule['assigned_tasks']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; ?>
