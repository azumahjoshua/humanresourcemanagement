<?php
session_start();

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

// Fetch all leave requests
$stmt = $pdo->prepare("SELECT * FROM time_off_requests");
$stmt->execute();
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
                            <th>Employee ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Leave Type</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leaveRequests as $request): ?>
                            <tr>
                                <td><?= $request['employee_id']; ?></td>
                                <td><?= $request['start_date']; ?></td>
                                <td><?= $request['end_date']; ?></td>
                                <td><?= $request['status']; ?></td>
                                <td><?= $request['leave_type']; ?></td>
                                <td><?= $request['reason']; ?></td>
                                <td>
                                    <a href="./includes/leaverequest.php?action=approve&request_id=<?= $request['request_id']; ?>" class="btn btn-success">Approve</a>
                                    <a href="./includes/leaverequest.php?action=reject&request_id=<?= $request['request_id']; ?>" class="btn btn-danger">Reject</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; // Include your footer template ?>
