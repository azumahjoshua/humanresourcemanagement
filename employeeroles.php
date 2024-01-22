<?php
session_start();
include './header.php';
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
$employeeQuery = $pdo->query("SELECT employee_id, full_name FROM employees");
$employees = $employeeQuery->fetchAll(PDO::FETCH_ASSOC);

// echo $employee;

$roleQuery = $pdo->query("SELECT role_id, role_name FROM roles");
$roles = $roleQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>
        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
    <div class="row align-items-center">
        <h2>Assign Role</h2>
        <form action="./includes/assignrole.php" method="POST">
            <div class="mb-3">
                <label for="employee_id" class="form-label">Select Employee:</label>
                <select name="employee_id" class="form-select" required>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['employee_id']; ?>"><?= $employee['full_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="role_id" class="form-label">Select Role:</label>
                <select name="role_id" class="form-select" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['role_id']; ?>"><?= $role['role_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Assign Role</button>
        </form>
    </div>
</main>
    </div>
</div>
<?php
include "./footer.php"
?>