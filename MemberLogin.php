<?php
session_start();

include "config.php";

$login_err = "";

// Function to fetch user data
function fetchUserData($mysqli, $username) {
    $sql = "SELECT * FROM members WHERE username=?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
    }
    return null;
}

// Login process
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM members WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            // Fetch user data and store in session
            $_SESSION['loggedin'] = true;
            $_SESSION['user_data'] = fetchUserData($conn, $username);
            header("Location: MemberHome.php");
            exit();
        } else {
            $login_err = "Invalid credentials";
        }
        $stmt->close();
    } else {
        $login_err = "Oops! Something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'Header.php'; ?>
  <div class="container">
    <div class="login-form">
      <h2>Member Login</h2>
      <form id="loginForm" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Login</button>
      </form>
      <?php if (!empty($login_err)) : ?>
        <p><?php echo $login_err; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <?php include 'Footer.php'; ?>
</body>
</html>
