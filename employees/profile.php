<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ./employees/index.php");
    exit();
}


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
$employeeId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ?");
$stmt->execute([$employeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

include "./header.php"; // Include your header template

?>

<div class="container-fluid">
    <div class="row">
        <?php include "./sidebar.php"; ?>
        
        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 employeedash">
            <div class="row align-items-center">
                <h1>Employee Profile</h1>
                <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>        
                <ul class="list-group">
                    <li class="list-group-item"><strong>Full Name:</strong> <?php echo $employee['full_name']; ?></li>
                    <li class="list-group-item"><strong>Date Of Birth:</strong> <?php echo $employee['date_of_birth']; ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo $employee['email']; ?></li>
                    <li class="list-group-item"><strong>Department:</strong> <?php echo $employee['department']; ?></li>
                    <li class="list-group-item"><strong>Position:</strong> <?php echo $employee['job_title']; ?></li>
                    <li class="list-group-item"><strong>Salary:</strong> <?php echo $employee['salary']; ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?php echo $employee['phone_number']; ?></li>
                    <li class="list-group-item"><strong>Address:</strong> <?php echo $employee['address']; ?></li>
                </ul>
            </div>
        </main>
    </div>
</div>


<?php include "./footer.php"; // Include your footer template ?>
