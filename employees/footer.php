
<!-- <div class="footer">
			<p>Human Resource Managemant System. All Rights Reserved &copy; <?= date("Y") ?> </p>
</div> -->
 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
<!-- <script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./service-worker.js')
      .then(registration => {
        console.log('Service Worker registered with scope:', registration.scope);
      })
      .catch(error => {
        console.error('Service Worker registration failed:', error);
      });
  }
</script>  -->

<!-- Include jQuery library in your HTML -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 

<script>
function recordAttendance(action) {
    let employeeId = $("#employee_id").val();

    // Make an AJAX request to the server-side script
    $.ajax({
        url: './includes/attendance.php',
        type: 'POST',
        data: { action: action, employeeId: employeeId },
        success: function(response) {
          console.log('Success:', response);
          alert('Attendance recorded successfully');
        },
        error: function(xhr, status, error) {
          console.log('Error:', error);
          alert('Error recording attendance. Check the console for details.');
        }

    });
}
</script> 

  </body>
</html>