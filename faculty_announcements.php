<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_type'], ['faculty', 'head'])) {
    header("Location: index.php");
    exit();
}

require_once 'db.php';

// Initialize variables
$edit_mode = false;
$edit_id = 0;
$title = '';
$content = '';
$message = '';

// Handle form submission for add or update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        // Update existing news
        $edit_id = intval($_POST['edit_id']);
        $stmt = $conn->prepare("UPDATE facultynews SET title = ?, content = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $edit_id);
        if ($stmt->execute()) {
            $message = "News updated successfully.";
        } else {
            $message = "Error updating news: " . $conn->error;
        }
        $stmt->close();
    } else {
        // Add new news
        $stmt = $conn->prepare("INSERT INTO facultynews (title, content, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $content);
        if ($stmt->execute()) {
            $message = "News added successfully.";
        } else {
            $message = "Error adding news: " . $conn->error;
        }
        $stmt->close();
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM facultynews WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $message = "News deleted successfully.";
    } else {
        $message = "Error deleting news: " . $conn->error;
    }
    $stmt->close();
}

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT title, content FROM facultynews WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    if ($stmt->fetch()) {
        $edit_mode = true;
    } else {
        $message = "News not found.";
    }
    $stmt->close();
}

// Fetch all news
$result = $conn->query("SELECT id, title, content, created_at FROM facultynews ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Faculty News - Faculty Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/dashboard_part2.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand project-title"><img src="comsats_logo.png" alt="COMSATS Logo">Comsats University Automation System</span>
        <span class="navbar-brand ms-3">Faculty Dashboard - Manage News</span>
        <div class="d-flex">
            <a href="head_dashboard.php" class="btn btn-light me-2">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-light">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <?php echo $edit_mode ? 'Edit News' : 'Add News'; ?>
        </div>
        <div class="card-body">
            <form method="post" action="faculty_announcements.php">
                <input type="hidden" name="edit_id" value="<?php echo $edit_mode ? $edit_id : ''; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required value="<?php echo htmlspecialchars($title); ?>">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
                </div>
                <button type="submit" class="btn btn-danger"><?php echo $edit_mode ? 'Update News' : 'Add News'; ?></button>
                <?php if ($edit_mode): ?>
                    <a href="faculty_announcements.php" class="btn btn-secondary ms-2">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <h3>Existing News</h3>
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <small>Created: <?php echo htmlspecialchars($row['created_at']); ?></small>
                    </div>
                    <p class="mb-1"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                    <div class="mt-2">
                        <a href="faculty_announcements.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary me-2">Edit</a>
                        <a href="faculty_announcements.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No news found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer mt-5">
    &copy; 2024 COMSATS University. All rights reserved.
</footer>
</body>
</html>
