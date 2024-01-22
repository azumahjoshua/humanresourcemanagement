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

// Fetch employees for dropdown
$employeeStmt = $pdo->prepare("SELECT employee_id, full_name FROM employees");
$employeeStmt->execute();
$employees = $employeeStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
                <!-- JavaScript to initiate the delete operation -->
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script>
                    function deleteSchedule(scheduleId) {
                        if (confirm("Are you sure you want to delete this schedule?")) {
                            $.ajax({
                                url: './includes/deleteschedule.php',
                                type: 'POST',
                                data: { scheduleId: scheduleId },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success) {
                                        alert(response.message);
                                        location.reload();
                                    } else {
                                        alert(response.message);
                                    }
                                },
                                error: function(error) {
                                    console.error('Error:', error);
                                    alert('Error deleting schedule');
                                }
                            });
                        }
                    }
                </script>
                <h2>Delete Schedule</h2>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($schedules as $schedule): ?>
                    <tr>
                        <td><?= $schedule['employee_id']; ?></td>
                        <td><?= $schedule['full_name']; ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteSchedule(<?= $schedule['schedule_id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; ?>
