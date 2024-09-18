<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php include 'Header.php'; ?>
  <div class="container">

    <div class="login-form">
      <h2>Admin Login</h2>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <!-- <div class="form-group">
        <label for="admin_code">Admin Code:</label>
b      </div> -->
      <button type="submit" onclick="handleLogin()">Login</button>
    </div>

  </div>

  <?php include 'Footer.php'; ?>
</body>
<script>
  function handleLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === 'admin' && password === 'admin') {
      // Redirect to home page
      window.location.href = 'AdminHome.php';
    } else {
      // Authentication failed
      alert("Invalid username or password. Please try again.");
    }
  }
</script>

</html>