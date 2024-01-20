<?php 
 include "./header.php";
?>
  <section id="hero" class="d-flex align-items-center mt-5">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            <h1>HR Management System</h1>
            <h2>Please select your role to login</h2>
            <a href="./admin.php" class="download-btn mx-5"><i class="bx bxl-play-store"></i> Admin Login</a>
            <a href="./employees/index.php" class="download-btn"><i class="bx bxl-apple"></i>Employee Login</a>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="./assets/images/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section>
<?php
  include "./footer.php"
 ?>