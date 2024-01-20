<?php 
 include "../header.php"
?>
  <div class="container login-container">
  <h2 class="text-center">Employee Login</h2>
  <form action="">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <input type="hidden" id="rolename" name="role" value="employee" />
    <button type="submit" class="btn btn-primary btn-block my-2">Login</button>
  </form>
  <p class="text-center mt-3"><a href="#">Forgot Password?</a></p>
</div>

 <?php
  include "../footer.php"
 ?>