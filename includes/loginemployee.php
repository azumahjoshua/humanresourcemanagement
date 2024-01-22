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

    $stmt = $pdo->prepare("SELECT employees.*, employee_roles.role_id
                      FROM employees
                      JOIN employee_roles ON employees.employee_id = employee_roles.employee_id
                      WHERE employees.username = ?");

    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if ($user) {
        if ($password === $user['password']) {
            $role_id = $user['role_id'];

            if ($role_id == 2) {
                $_SESSION['user_id'] = $user['employee_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = false;
                header("Location: ../employees/employeedashboard.php?success");
                exit();
            } else {
                header("Location: ../employees/index.php?error_message=Invalid user role");
                exit();
            }
        } else {
            header("Location: ../employees/index.php?error_message=Invalid password");
            exit();
        }
    } else {
        header("Location: ../employees/index.php?error_message=User not found");
        exit();
    }
}
?>
