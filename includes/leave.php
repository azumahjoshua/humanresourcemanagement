
<?php
session_start();

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from the session
    $employeeId = $_SESSION['user_id'];

    // Get form data
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $reason = $_POST['reason'];
    $leave_type= $_POST['leave_type'];

    // print_r($leave_type);

    try {
        
        $stmt = $pdo->prepare("INSERT INTO time_off_requests (employee_id,start_date,end_date,`status`, leave_type, reason)
        VALUES (?, ?, ?, 'Pending', ?, ?)");
        $stmt->execute([$employeeId, $startDate, $endDate, $leave_type, $reason]);

        print_r($stmt);

        header("location: ../employees/vacation.php?message=Time-off request submitted successfully");
        // echo json_encode(['success' => true, 'message' => 'Time-off request submitted successfully']);
    } catch (PDOException $e) {
        // Provide an error response        
        
        header("location: ../employees/vacation.php?message=Error processing time-off request");

        // echo json_encode(['success' => false, 'message' => 'Error processing time-off request']);
    }
} else {
    // Invalid request method
    header("location: ../employees/vacation.php?message=Invalid Request");
    // echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
