<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

// Fetch users based on role
if ($user_role === 'student') {
    $stmt = $conn->prepare("SELECT id, name FROM users WHERE role = 'faculty'");
} elseif ($user_role === 'faculty') {
    $stmt = $conn->prepare("SELECT id, name FROM users WHERE role = 'student'");
} else {
    $stmt = $conn->prepare("SELECT id, name FROM users WHERE id != ?");
    $stmt->bind_param("i", $user_id);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messaging</title>
    <link rel="stylesheet" href="message_style.css">
</head>
<body>
    <h2>Real-time Messaging</h2>
    <select id="receiver">
        <option value="">Select User</option>
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
        <?php endwhile; ?>
    </select>
    <div id="chat-box"></div>
    <textarea id="message" placeholder="Type your message..."></textarea>
    <button onclick="sendMessage()">Send</button>
    <script>
        const userId = <?= $user_id ?>;
    </script>
    <script src="message_script.js"></script>
</body>
</html>