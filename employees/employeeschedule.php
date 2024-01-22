<?php
session_start();

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

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../employees/index.php");
    exit();
}

// Fetch employee schedules
$employeeId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM schedules WHERE employee_id = ?");
$stmt->execute([$employeeId]);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "./header.php"; // Include your header template
?>

<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 employeedash">
            <div class="row align-items-center">
                <h2><?php echo $_SESSION['username']; ?> Schedule</h2>

                <!-- Display a list of schedules -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Schedule ID</th>
                            <th>Employee ID</th>
                            <th>Working Hours</th>
                            <th>Assigned Tasks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedules as $schedule): ?>
                            <tr>
                                <td><?= $schedule['schedule_id']; ?></td>
                                <td><?= $schedule['employee_id']; ?></td>
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

<?php include "./footer.php"; // Include your footer template ?>
