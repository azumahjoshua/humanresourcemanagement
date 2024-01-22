<?php
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $role_id = $_POST['role_id'];

   

    try {
        $stmt = $pdo->prepare("INSERT INTO employee_roles (employee_id, role_id) VALUES (?, ?)");
        $stmt->execute([$employee_id, $role_id]);

        // Redirect to a success page or wherever you want after successful assignment
        header("Location: ../viewemployees.php?success='successful assignment'");
        exit();
    } catch (PDOException $e) {
        // Handle database error
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to an error page or handle accordingly
    // header("Location: error.php");
    exit();
}
?>
