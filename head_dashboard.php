<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'head') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HOD Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">Head Dashboard</span>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-light">Logout</a>
  </div>
</div>
</nav>

<div class="dashboard-container">
  <h2 class="mb-4">Welcome, Head of Department!</h2>

  <div class="row">

    <!-- Full Timetable Control -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-success text-white">Full Timetable Control</div>
        <div class="card-body">
          <p>View and update the complete university timetable.</p>
          <a href="upload_pdf.php" class="btn btn-success btn-sm">Upload Timetable</a>
          <a href="view.php" class="btn btn-success btn-sm">View Timetable</a>
          <a href="find_free_slots.php" class="btn btn-success btn-sm">Find Free Slot</a>
        </div>
      </div>
    </div>

    <!-- Notifications Control -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-info text-white">Notifications Management</div>
        <div class="card-body">
          <p>Create and modify exam/event notices.</p>
          <a href="hod_notifications.php" class="btn btn-info btn-sm">Manage Notifications</a>
        </div>
      </div>
    </div>

    <!-- Messages and Broadcast -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-warning text-dark">Messaging & Communication</div>
        <div class="card-body">
          <p>Send group or broadcast messages to students and faculty.</p>
          <a href="chat_interface.php" class="btn btn-warning btn-sm">Send Messages</a>
        </div>
      </div>
    </div>

    <!-- News and Announcements -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-danger text-white">Univeristy News</div>
        <div class="card-body">
          <p>Publish and edit university news and events.</p>
          <a href="announcements.php" class="btn btn-danger btn-sm">Manage Student News</a>
          <a href="faculty_announcements.php" class="btn btn-danger btn-sm"> Manage Faculty News</a>
        </div>
      </div>
    </div>

    <!-- Feedback Management -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-secondary text-white">Feedback Management</div>
        <div class="card-body">
          <p>Analyze feedback from students and faculty.</p>
          <a href="hod_feedback.php" class="btn btn-secondary btn-sm">View Feedback</a>
        </div>
      </div>
    </div>

    <!-- Sports Week Management -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-dark text-white">Sports Week Management</div>
        <div class="card-body">
          <p>Plan sports events, match schedules, and send SMS alerts.</p>
          <a href="hod_sports.php" class="btn btn-dark btn-sm">Manage Sports Week</a>
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
