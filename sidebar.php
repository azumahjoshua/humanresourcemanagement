<?php
    session_start();
    $host = "localhost";
    $dbname = 'humanresourcemanagement';
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
?>
<aside class="col-12 col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="./admindashboard.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <nav class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="./admindashboard.php" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link px-0 align-middle" data-bs-toggle="dropdown">
                    <i class="fs-4 bi-speedometer2"></i>
                    <span class="ms-1 d-none d-sm-inline">Manage Employees</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./viewemployees.php">View Employees</a></li>
                    <li><a class="dropdown-item" href="./addemployee.php">Add Employees</a></li>
                    <li><a class="dropdown-item" href="./employeeroles.php">Add Roles</a></li>
                    <li><a class="dropdown-item" href="./attendance.php">Attendance</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link px-0 align-middle" data-bs-toggle="dropdown">
                    <i class="fs-4 bi-speedometer2"></i>
                    <span class="ms-1 d-none d-sm-inline">Schedule</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./createschedule.php">Create schedule</a></li>
                    <li><a class="dropdown-item" href="./viewSchedules.php">View Schedule</a></li>
                    <li><a class="dropdown-item" href="./editschedules.php">Edit Schedule</a></li>
                    <li><a class="dropdown-item" href="./deleteschedule.php">Delete Schedule</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="./leaverequest.php" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Leave Request</span>
                </a>
            </li>
        </nav>
        <hr class="d-sm-none"> 
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['username'];?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="./logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
</aside>
