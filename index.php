<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login / Signup</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --bg-color: #f8f9fa;
      --text-color: #212529;
      --form-bg: #ffffff;
      --button-bg: #0d6efd;
      --button-text: #ffffff;
    }
    [data-theme="dark"] {
      --bg-color: #212529;
      --text-color: #f8f9fa;
      --form-bg: #343a40;
      --button-bg: #0dcaf0;
      --button-text: #212529;
    }
    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.3s, color 0.3s;
    }
    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .auth-card {
      background-color: var(--form-bg);
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      position: relative;
    }
    .form-toggle {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }
    .btn-theme-toggle {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: var(--button-bg);
      color: var(--button-text);
      border: none;
      padding: 10px 15px;
      border-radius: 50px;
      cursor: pointer;
    }
    #role-group,
    #name-group,
    #department-group,
    #semester-group {
      display: none; /* Initially hidden because they are only for Signup */
    }
  </style>
</head>

<body data-theme="dark">
  

  <div class="auth-container">
    <div class="auth-card">
      <h2 id="form-title" class="text-center mb-4">Login</h2>

      <form id="auth-form" action="login.php" method="POST">
        <div class="mb-3">
          <label for="login_input" class="form-label">Email or Phone</label>
          <input type="text" class="form-control" id="login_input" name="login_input" required />
        </div>

        <div class="mb-3" id="name-group">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" />
        </div>

        <div class="mb-3" id="department-group">
          <label for="department" class="form-label">Department</label>
          <input type="text" class="form-control" id="department" name="department" />
        </div>

        <div class="mb-3" id="role-group">
          <label for="role" class="form-label">Role</label>
          <select class="form-select" id="role" name="role">
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="head">Head</option>
          </select>
        </div>

        <div class="mb-3" id="semester-group">
          <label for="semester" class="form-label">Semester (for students)</label>
          <input type="number" min="1" max="8" class="form-control" id="semester" name="semester" />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required />
        </div>

        <button type="submit" class="btn w-100" style="background-color: var(--button-bg); color: var(--button-text)">
          Proceed
        </button>
      </form>

      <div class="form-toggle">
        <span id="toggle-text">Already have an account?</span>
        <button class="btn btn-link" onclick="toggleForm()">Click here</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let isLogin = true;

    function toggleForm() {
      const form = document.getElementById("auth-form");
      const title = document.getElementById("form-title");
      const toggleText = document.getElementById("toggle-text");
      const roleGroup = document.getElementById("role-group");
      const nameGroup = document.getElementById("name-group");
      const departmentGroup = document.getElementById("department-group");
      const semesterGroup = document.getElementById("semester-group");

      if (isLogin) {
        title.innerText = "Signup";
        form.action = "signup.php";
        toggleText.innerText = "Already have an account?";
        roleGroup.style.display = "block";
        nameGroup.style.display = "block";
        departmentGroup.style.display = "block";
        semesterGroup.style.display = "block";
      } else {
        title.innerText = "Login";
        form.action = "login.php";
        toggleText.innerText = "Don't have an account?";
        roleGroup.style.display = "none";
        nameGroup.style.display = "none";
        departmentGroup.style.display = "none";
        semesterGroup.style.display = "none";
      }
      isLogin = !isLogin;
    }
  </script>

  <footer class="footer">
    &copy; 2024 COMSATS University. All rights reserved.
  </footer>
</body>
</html>
