<?php
session_start();

// Check if the user is logged in and is not an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin']) {
    header("Location: ../employees/index.php");
    exit();
}

include "./header.php"
?>

<div class="container-fluid">
    <div class="row">
        <?php
            include "./sidebar.php"
        ?>

<main class="col-md-9 ms-sm-auto px-md-4 mt-5 employeedash">
    <div class="row align-items-center">
        <div class="col-md-5">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Great job, your affiliate dashboard is ready to go!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quisquam aliquid nihil, dolores ullam blanditiis veritatis. Vitae qui, eligendi animi quidem, corporis repellendus, nobis natus minima ipsam maiores rerum? Sint!</p>
            <a class="btn btn-primary" href="./addemployee.php" role="button">Add Employee</a>
            <a class="btn btn-primary" href="./viewemployees.php" role="button">View Employee</a>
        </div>
        <div class="col-md-7">
            <img src="../assets/images/profile.jpg" alt="<?php echo $_SESSION['username']; ?>" class="img-fluid rounded-circle" style="width: 250px; height: 250px;">
        </div>
    </div>
</main>

    </div>
</div>
<?php
include "./footer.php"
?>