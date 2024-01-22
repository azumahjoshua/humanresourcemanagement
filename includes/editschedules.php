<?php
session_start();

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


// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scheduleId = $_POST['scheduleId'];
    $employeeId = $_POST['employeeId'];
    $workingHours = $_POST['working_hours'];
    $assignedTasks = $_POST['assigned_tasks'];

    // Update the schedule in the database
    $updateStmt = $pdo->prepare("
        UPDATE schedules
        SET employee_id = ?, working_hours = ?, assigned_tasks = ?
        WHERE schedule_id = ?
    ");
    
    try {
        $updateStmt->execute([$employeeId, $workingHours, $assignedTasks, $scheduleId]);
        header("Location: ../viewSchedules.php");
        // echo "Schedule updated successfully!";
    } catch (PDOException $e) {
        echo "Error updating schedule: " . $e->getMessage();
    }
}
?>



