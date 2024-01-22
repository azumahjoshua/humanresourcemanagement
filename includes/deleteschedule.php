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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $scheduleId = $_POST['scheduleId'];

    // Prepare and execute the SQL query to delete the schedule
    $deleteStmt = $pdo->prepare("DELETE FROM schedules WHERE schedule_id = ?");
    $deleteStmt->execute([$scheduleId]);

    // Check if the deletion was successful
    if ($deleteStmt->rowCount() > 0) {
        // Redirect to the view schedules page with a success message
        header("Location: ./viewSchedules.php?success=1");
        exit();
    } else {
        header("Location: ./viewSchedules.php?error=1");
        exit();
    }
} else {

    header("Location: ./ViewSchedules.php");
    exit();
}

?>

