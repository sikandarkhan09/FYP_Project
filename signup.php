<?php
// signup.php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive inputs
$email = trim($_POST['login_input']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);
$name = trim($_POST['name']);
$department = trim($_POST['department']);
$semester = isset($_POST['semester']) ? trim($_POST['semester']) : null;

// Validate
if (empty($email) || empty($password) || empty($role) || empty($name) || empty($department)) {
    die("Please fill all fields.");
}

if ($role == 'student' && (empty($semester) || !is_numeric($semester) || $semester < 1 || $semester > 8)) {
    die("Please provide a valid semester between 1 and 8.");
}

// Email format validation based on role
if ($role == 'student') {
    if (!preg_match('/^(SP|FA)(\d{2})-(\w+)-(\d{3})@cuiatk\.edu\.pk$/', $email)) {
        die("Invalid student email format! Expected format: SP/FA(year)-Degree-RollNo(3Digit)@cuiatk.edu.pk");
    }
} elseif ($role == 'faculty' || $role == 'head') {
    if (!preg_match('/^[^@]+@cuiatk\.edu\.pk$/', $email)) {
        die("Invalid email format for faculty/head! Email must end with @cuiatk.edu.pk");
    }
} else {
    die("Invalid role specified.");
}

// Head unique check
if ($role == 'head') {
    $head_check = $conn->query("SELECT * FROM users WHERE user_type = 'head'");
    if ($head_check->num_rows > 0) {
        echo "<script>alert('A head already exists. Only one head can register.'); window.location.href='index.php';</script>";
        exit();
    }
}

// Extract degree for students
$degree = '';
if ($role == 'student') {
    if (preg_match('/^(SP|FA)(\d{2})-(\w+)-(\d{3})@cuiatk\.edu\.pk$/', $email, $matches)) {
        $degree = $matches[3];
    } else {
        die("Invalid student email format!");
    }
}

// Combine degree and semester
$degree_semester = null;
if ($role == 'student') {
    $degree_semester = $degree . '-' . $semester;
}

// Generate registration ID
$reg_id = generateRegOrFacultyID($email, $role, $department);

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ✅ Check for duplicate email
$checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$checkEmail->store_result();

if ($checkEmail->num_rows > 0) {
    echo "<script>alert('Email already registered. Please use a different email.'); window.location.href='index.php';</script>";
    $checkEmail->close();
    $conn->close();
    exit();
}
$checkEmail->close();

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, department, email, password, user_type, registration_id, semester) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $department, $email, $hashedPassword, $role, $reg_id, $degree_semester);

if ($stmt->execute()) {
    echo "<script>alert('Signup Successful! Now Login'); window.location.href='index.php';</script>";
} else {
    echo "Signup failed: " . $stmt->error;
}

$stmt->close();
$conn->close();

function generateRegOrFacultyID($email, $role, $department) {
    if ($role == 'student') {
        if (preg_match('/^(SP|FA)(\d{2})-(\w+)-(\d{3})@cuiatk\.edu\.pk$/', $email, $matches)) {
            $sem = $matches[1];
            $year = $matches[2];
            $degree = $matches[3];
            $roll = $matches[4];
            return "$sem$year-$degree-$roll";
        } else {
            die("Invalid student email format!");
        }
    } elseif ($role == 'faculty' || $role == 'head') {
        $departmentCode = strtoupper(substr($department, 0, 2));
        $fac_no = rand(1, 50);
        return "$departmentCode-" . str_pad($fac_no, 3, "0", STR_PAD_LEFT);
    } else {
        die("Invalid role specified.");
    }
}
?>
