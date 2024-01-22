<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $host = "localhost";
    $dbname = 'humanresourcemanagement';
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch (PDOException $e) {
        echo json_encode(['Error' => false, 'message' => 'Database connection failed']);
        exit();
    }

    $employeeId = $_POST['employeeId'];
    // print_r($employeeId);
    $action = $_POST['action'];
    $attendanceDate = date('Y-m-d H:i:s');
    $clockInTime = '08:00:00'; 
    $clockOutTime = '17:00:00';
    
    $sql = "INSERT INTO attendance (employee_id, attendance_date, clock_in_time, clock_out_time, `status`)
            VALUES (?, ?, ?, ?, ?)";
    $stmt->execute([$employeeId, $attendanceDate,$clockInTime, $clockOutTime, $action]);
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
