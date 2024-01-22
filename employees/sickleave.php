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
                <h1>Sick Leave Request</h1>
                <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
                <p class="success"><?php echo $_GET['message']; ?></p>
                <!-- Vacation Request Form -->
                <form action="../includes/leave.php" method="POST">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Leave Type:</label>
                        <input type="text" class="form-control" id="end_date" name="leave_type" value="sick leave">
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Leave:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include "./footer.php"; // Include your footer template ?>
