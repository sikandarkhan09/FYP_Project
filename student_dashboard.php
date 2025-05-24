   <?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">Student Dashboard</span>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-light">Logout</a>
  </div>
</div>
</nav>

<div class="dashboard-container">
  <h2 class="mb-4">Welcome, Student!</h2>

  <div class="row">

    <!-- Timetable -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-success text-white">Timetable</div>
        <div class="card-body">
          <p>View your weekly class schedule here.</p>
          <a href="view.php" class="btn btn-success btn-sm">View Timetable</a>
        </div>
      </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-info text-white">Notifications</div>
        <div class="card-body">
          <p>Get reminders for classes, exams, and events.</p>
          <a href="view_notifications.php" class="btn btn-info btn-sm">View Notifications</a>
        </div>
      </div>
    </div>

    <!-- Messages / Communication -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-warning text-dark">Messages</div>
        <div class="card-body">
          <p>Directly message teachers, advisors, and HODs.</p>
          <a href="chat_interface.php" class="btn btn-warning btn-sm">Open Messages</a>
        </div>
      </div>
    </div>

    <!-- University News -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-danger text-white">University News</div>
        <div class="card-body">
          <p>Stay updated with latest university News.</p>
          <a href="view_student_news.php" class="btn btn-danger btn-sm">View News</a>
        </div>
      </div>
    </div>

    <!-- Feedback System -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-secondary text-white">Feedback System</div>
        <div class="card-body">
          <p>Submit feedback for classes, exams, and events.</p>
          <a href="submit_feedback.php" class="btn btn-secondary btn-sm">Give Feedback</a>
        </div>
      </div>
    </div>

    <!-- Sports Week -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-dark text-white">Sports Week</div>
        <div class="card-body">
          <p>See sports event schedule and venues.</p>
          <a href="sports_week.php" class="btn btn-dark btn-sm">View Sports Events</a>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer">
  &copy; 2024 COMSATS University. All rights reserved.
</footer>

</body>
</html>
