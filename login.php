<?php
// Start the session
session_start();

require_once 'db.php'; // Make sure this connects to your database

function redirect_with_alert($message, $location = 'index.php') {
    echo "<script>alert('$message'); window.location.href='$location';</script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user inputs
    $login_input = trim($_POST['login_input'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($login_input) || empty($password)) {
        redirect_with_alert('Please fill in all fields!');
    }

    // Determine login field (email or phone)
    $field = '';
    if (filter_var($login_input, FILTER_VALIDATE_EMAIL)) {
        $field = "email";
    } elseif (preg_match('/^\+?\d{10,15}$/', $login_input)) {
        $field = "phone";
    } else {
        redirect_with_alert('Please enter a valid Email or Phone number!');
    }

    // Prepare a safe query
    $sql = "SELECT * FROM users WHERE $field = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Save user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on role
            switch ($user['user_type']) {
                case 'head':
                    header("Location: head_dashboard.php");
                    exit();
                case 'faculty':
                    header("Location: faculty_dashboard.php");
                    exit();
                case 'student':
                    header("Location: student_dashboard.php");
                    exit();
                default:
                    redirect_with_alert('Invalid user role assigned.');
            }
        } else {
            redirect_with_alert('Incorrect password!');
        }
    } else {
        redirect_with_alert('No user found with this Email or Phone!');
    }
} else {
    header("Location: index.php");
    exit();
}
?>