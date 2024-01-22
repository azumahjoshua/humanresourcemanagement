<?php
session_start();

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit();
// }

$host = "localhost";
$dbname = 'humanresourcemanagement';
$username = "root";
$password = "";

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully!";
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
exit();
}

// Get employee ID from the session
$employeeId = $_SESSION['user_id'];

// Fetch leave requests for the employee
$stmt = $pdo->prepare("SELECT * FROM time_off_requests WHERE employee_id = ?");
$stmt->execute([$employeeId]);
$leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "./header.php"; // Include your header template
?>

<div class="container-fluid">
    <div class="row">
         <?php include_once "./sidebar.php"; ?>
        <main class="col-md-9 ms-sm-auto px-md-4 mt-5">
            <div class="row align-items-center">
                <h2>Leave Requests</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Leave Type</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leaveRequests as $request): ?>
                            <tr>
                                <td><?= $request['request_id']; ?></td>
                                <td><?= $request['start_date']; ?></td>
                                <td><?= $request['end_date']; ?></td>
                                <td><?= $request['status']; ?></td>
                                <td><?= $request['leave_type']; ?></td>
                                <td><?= $request['reason']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; // Include your footer template ?>
