<?php
// Upload and Process Timetable PDF

if (isset($_POST['submit'])) {
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $file = $_FILES['file']['tmp_name'];
    $destination = "uploads/" . $_FILES['file']['name'];

    if (move_uploaded_file($file, $destination)) {
        // Call Python to extract timetable
        $command = escapeshellcmd("python extract_timetable.py \"" . $destination . "\"");
        $output = shell_exec($command);

        // You can log $output if needed for debugging
        // Redirect to view.php after processing
        header("Location: view.php");
        exit();
    } else {
        $error = "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Timetable PDF</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
    <span class="navbar-brand ms-3">Upload Timetable PDF</span>
    <div class="d-flex">
      <button onclick="history.back()" class="btn btn-secondary me-2">Go Back</button>
      <a href="logout.php" class="btn btn-light">Logout</a>
    </div>
  </div>
</nav>

<div class="dashboard-container py-5">
  <div class="card p-4 shadow-sm">
    <h2 class="mb-4">Upload Timetable PDF</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Upload and Process</button>
    </form>
  </div>
</div>

<footer class="footer">
  &copy; 2024 COMSATS University. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
