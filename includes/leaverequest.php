<?php
session_start();

// Check if the user is logged in as an admin
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if action and request_id are set
    if (isset($_GET['action']) && isset($_GET['request_id'])) {
        $action = $_GET['action'];
        $requestId = $_GET['request_id'];

        // Validate action
        if ($action === 'approve' || $action === 'reject') {
            // Update the status of the leave request
            $status = ($action === 'approve') ? 'Approved' : 'Rejected';
            $stmt = $pdo->prepare("UPDATE time_off_requests SET status = ? WHERE request_id = ?");
            $stmt->execute([$status, $requestId]);
            header("Location: ../leaverequest.php");
            exit();
        }
    }
}

// If the action or request_id is not set or the method is not GET, redirect to leaveRequest.php with an error message
header("Location: ./leaveRequest.php?message=Invalid Request");
exit();
?>
