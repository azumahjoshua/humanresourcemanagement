<?php
session_start();

include './includes/connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$host = "localhost";
$dbname = 'humanresourcemanagement';
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Check if $pdo is defined
    if (!isset($pdo)) {
        echo "Error: Database connection not established.";
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM employees WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validate user credentials
    if ($user) {
        // For testing purposes, compare plaintext password directly
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['employee_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = true;
            header("Location: ../admindashboard.php");
            exit();
        } else {
            header("Location:../admin.php?error_message=Invalid password");
            exit();
        }
    } else {
        header("Location:../admin.php?error_message=User not found");
        exit();
    }
}
?>
