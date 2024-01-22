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
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $full_name = validate($_POST['full_name']);
    $email = validate($_POST['email']);
    $phone_number = validate($_POST['phone_number']);
    $address = validate($_POST['address']);
    $date_of_birth = validate($_POST['date_of_birth']);
    $hire_date = validate($_POST['hire_date']);
    $salary = validate($_POST['salary']);
    $department = validate($_POST['department']);
    $job_title = validate($_POST['job_title']);


    if (!isset($pdo)) {
        echo "Error: Database connection not established.";
        exit();
    }

    // Check if the username already exists
    $stmt_check_username = $pdo->prepare("SELECT * FROM employees WHERE username = ?");
    $stmt_check_username->execute([$username]);

    if ($stmt_check_username->rowCount() > 0) {
        // Username already exists
        header("Location: ../addemployee.php?error_message=Username already exists");
        exit();
    }

    // Hash the password before storing it in the database
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the employee details into the database
    $stmt = $pdo->prepare("INSERT INTO employees (username, password, full_name, email, phone_number, address, date_of_birth, hire_date, salary, department, job_title)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$username, $password, $full_name, $email, $phone_number, $address, $date_of_birth, $hire_date, $salary, $department, $job_title]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../viewemployees.php?success_message=Employee added successfully");
        exit();
    } else {
        header("Location: ../addemployee.php?error_message=Error adding employee");
        exit();
    }
} else {
    // Redirect if accessed without a POST request
    header("Location: ../addemployee.php");
    exit();
}
?>
