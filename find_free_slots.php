<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$days = ['Mo', 'Tu', 'We', 'Th', 'Fr'];
$periods = ['1', '2', '3', '4', '5'];

$freeSlots = [];

if (isset($_POST['find'])) {
    $selectedClass = $_POST['class_name'];

    foreach ($days as $day) {
        foreach ($periods as $period) {
            $sql = "SELECT course FROM timetable 
                    WHERE class_name = '$selectedClass' 
                    AND day = '$day' 
                    AND time_slot = '$period'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $course = trim($row['course']);

                if (empty($course)) {
                    $freeSlots[] = ['day' => $day, 'period' => $period];
                }
            } else {
                $freeSlots[] = ['day' => $day, 'period' => $period];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Find Free Slots</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">Find Free Slots</span>
    <div class="d-flex">
      <button onclick="history.back()" class="btn btn-secondary me-2">Go Back</button>
      <a href="logout.php" class="btn btn-light">Logout</a>
    </div>
  </div>
</nav>

<div class="dashboard-container py-5">
  <h2 class="text-center mb-5">Find Free Slots</h2>

  <form method="post" class="card p-4 shadow-sm mb-4">
      <div class="mb-3">
          <select name="class_name" class="form-select" required>
              <option value="">-- Select Class --</option>
              <?php
              $classSql = "SELECT DISTINCT class_name FROM timetable ORDER BY class_name ASC";
              $classResult = $conn->query($classSql);
              while ($row = $classResult->fetch_assoc()) {
                  echo "<option value='".htmlspecialchars($row['class_name'])."'>".htmlspecialchars($row['class_name'])."</option>";
              }
              ?>
          </select>
      </div>
      <button type="submit" name="find" class="btn btn-primary">Find Free Slots</button>
  </form>

  <?php if (!empty($freeSlots)) { ?>
      <h3 class="mt-5 mb-3">Available Free Slots for <?php echo htmlspecialchars($selectedClass); ?></h3>
      <div class="table-responsive">
          <table class="table table-bordered text-center">
              <thead class="table-dark">
                  <tr>
                      <th>Day</th>
                      <th>Period</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($freeSlots as $slot) { ?>
                      <tr>
                          <td><?php echo htmlspecialchars($slot['day']); ?></td>
                          <td><?php echo "Period " . htmlspecialchars($slot['period']); ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
  <?php } ?>

  <div class="text-center mt-4">
  </div>
  <button class="btn btn-secondary" onclick="history.back()">Go Back</button>
</div>

<footer class="footer">
  &copy; 2024 COMSATS University. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
