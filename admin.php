<?php 
include "./header.php";
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// session_start();
?>

<div class="container admin-container">
    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
    <h2 class="text-center">Admin Login</h2>
    <form action="./includes/loginadmin.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <!-- Add any additional form fields as needed -->
        <button type="submit" class="btn btn-primary btn-block my-2">Login</button>
    </form>

    <!-- <p class="text-center mt-3"><a href="#">Forgot Password?</a></p> -->
</div>

<?php
include "./footer.php";
?>
