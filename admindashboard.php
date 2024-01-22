<?php 
session_start();
include "./header.php";
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once "./sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto px-md-4 mt-5 admindash">
            <div class="row align-items-center">
            <div class="col-md-5 col-sm-12" style="padding-left: 20px;">
                <h1>Welcome back, your dashboard is ready!</h1>
                <p>Great job, your affilate dashboard is ready to go! </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quisquam aliquid nihil, dolores ullam blanditiis veritatis. Vitae qui, eligendi animi quidem, corporis repellendus, nobis natus minima ipsam maiores rerum? Sint!</p>
                <a class="btn btn-primary" href="./addemployee.php" role="button">Add Employee</a>
                <a class="btn btn-primary" href="./viewemployees.php" role="button">View Employee</a>

            </div>
            <div class="col-md-7 col-sm-12">
                <img src="./assets/images/stat.jpg" class="img-fluid" alt="" style="height: 500px;">
            </div>
            </div>
            <!-- Add more content as needed -->
        </main>
    </div>
</div>
<?php
  include "./footer.php"
 ?>
