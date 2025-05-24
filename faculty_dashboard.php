<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'faculty') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faculty Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">Faculty Dashboard</span>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-light">Logout</a>
  </div>
</div>
</nav>

<div class="dashboard-container">
  <h2 class="mb-4">Welcome, Faculty!</h2>

  <div class="row">

    <!-- Teaching Timetable -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-primary text-white">Teaching Timetable</div>
        <div class="card-body">
          <p>View your daily/weekly class schedule here.</p>
          <a href="view.php" class="btn btn-primary btn-sm">View Timetable</a>
          <a href="find_free_slots.php" class="btn btn-primary btn-sm">Find Free Slot</a>
        </div>
      </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-info text-white">Notifications</div>
        <div class="card-body">
          <p>Get notified about class changes and exam duties.</p>
          <a href="faculty_notifications.php" class="btn btn-info btn-sm">View Notifications</a>
        </div>
      </div>
    </div>

    <!-- Messages / Communication -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-warning text-dark">Messages</div>
        <div class="card-body">
          <p>Send direct messages to students and groups.</p>
          <a href="chat_interface.php" class="btn btn-warning btn-sm">Open Messages</a>
        </div>
      </div>
    </div>

    <!-- Announcements -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-danger text-white">Univeristy News</div>
        <div class="card-body">
          <p>Stay updated with latest university News regarding Faculty.</p>
          <a href="view_faculty_news.php" class="btn btn-danger btn-sm">View News</a>
        </div>
      </div>
    </div>

    <!-- Feedback View -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-secondary text-white">Feedback</div>
        <div class="card-body">
          <p>View student feedback on your subjects and exams.</p>
          <a href="faculty_feedback.php" class="btn btn-secondary btn-sm">View Feedback</a>
        </div>
      </div>
    </div>

    <!-- Sports Event Participation -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-dark text-white">Sports Events</div>
        <div class="card-body">
          <p>See your sports duty schedule and coordination messages.</p>
          <a href="faculty_sports.php" class="btn btn-dark btn-sm">View Sports Duties</a>
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
