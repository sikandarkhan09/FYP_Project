<?php
// Connect to Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch classes
$classSql = "SELECT DISTINCT class_name FROM timetable";
$classResult = $conn->query($classSql);

$days = ['Mo', 'Tu', 'We', 'Th', 'Fr'];
$periods = ['1', '2', '3', '4', '5' ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faculty Dashboard - Timetables</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">View Timetable</span>
    <div class="d-flex">
      <button onclick="history.back()" class="btn btn-secondary me-2">Go Back</button>
      <a href="logout.php" class="btn btn-light">Logout</a>
    </div>
  </div>
</nav>

<div class="dashboard-container py-5">
  <h1 class="text-center mb-5">University Timetables</h1>

  <?php
  if ($classResult->num_rows > 0) {
      while ($classRow = $classResult->fetch_assoc()) {
          $className = $classRow['class_name'];

          $sql = "SELECT * FROM timetable WHERE class_name = '$className'";
          $result = $conn->query($sql);

          $timetable = [];
          foreach ($days as $day) {
              foreach ($periods as $period) {
                  $timetable[$day][$period] = '';
              }
          }

          while ($row = $result->fetch_assoc()) {
              $day = $row['day'];
              $period = $row['time_slot'];
              $course = $row['course'];
              $faculty = $row['faculty'];
              $room = $row['room'];

              $info = "$course<br><small>$faculty<br><b>$room</b></small>";
              $timetable[$day][$period] = $info;
          }
  ?>

  <div class="card shadow-sm mb-5">
      <div class="card-body">
          <h3 class="text-center"><?php echo htmlspecialchars($className); ?> Timetable</h3>
          <div class="table-responsive">
              <table class="table table-bordered text-center align-middle">
                  <thead class="table-dark">
                      <tr>
                          <th>Day/Period</th>
                          <?php foreach ($periods as $period) { ?>
                              <th>Period <?php echo $period; ?></th>
                          <?php } ?>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($days as $day) { ?>
                          <tr>
                              <td><strong><?php echo $day; ?></strong></td>
                              <?php foreach ($periods as $period) { ?>
                                  <td><?php echo $timetable[$day][$period]; ?></td>
                              <?php } ?>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <?php
      }
  } else {
      echo "<p class='text-center'>No timetables available.</p>";
  }

  $conn->close();
  ?>
</div>

<footer class="footer">
  &copy; 2024 COMSATS University. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
