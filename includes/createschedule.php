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

// Fetch employees for dropdown
$employeeStmt = $pdo->prepare("SELECT employee_id, full_name FROM employees");
$employeeStmt->execute();
$employees = $employeeStmt->fetchAll(PDO::FETCH_ASSOC);

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'];
    $workingHours = $_POST['working_hours'];
    $assignedTasks = $_POST['assigned_tasks'];

    // Insert new schedule into the database
    $insertStmt = $pdo->prepare("
        INSERT INTO schedules (employee_id, working_hours, assigned_tasks, created_at)
        VALUES (?, ?, ?, NOW())
    ");
    
    try {
        $insertStmt->execute([$employeeId, $workingHours, $assignedTasks]);
        header("Location: ../viewSchedules.php");
    } catch (PDOException $e) {
        echo "Error creating schedule: " . $e->getMessage();
    }
}
?>