<?php
session_start();

include "config.php";

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM members WHERE username=? AND password=?";
  $stmt = $mysqli->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      // Fetch user data
      $user_data = $result->fetch_assoc();

      // Store user data in session
      $_SESSION['loggedin'] = true;
      $_SESSION['user_data'] = $user_data;

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

// If user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: Memberlogin.php");
  exit;
}

// Retrieve user data from session
$user_data = $_SESSION['user_data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Profile</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    p {
      padding: 10px;
      /* border-bottom: 1px solid #ddd; */
      display: block;
      /* Display as block to achieve column layout */
    }

    th {
      text-align: left;
      /* background-color: #f2f2f2; */
    }

    p {
      text-align: right;
    }
  </style>
</head>

<body>
  <?php include 'MemberHeader.php'; ?>
  <div class="container">
    <h2>Member Profile</h2>


    <table class='profile-table'>

      <tr>
        <th id="th">Member ID : <p id="p"><?php echo $user_data['memberid']; ?></p>
          </p>
        <th id="th">Name :<p id="p"><?php echo $user_data['name']; ?></p>
          </td>
        <th id="th">Email : <p id="p"><?php echo $user_data['email']; ?></p>
        </th>
        <th id="th">Username : <p id="p"><?php echo $user_data['username']; ?></p>
        </th>
        <th id="th">Password : <p id="p"><?php echo $user_data['password']; ?></p>
        </th>
        <th id="th">DOB : <p id="p"><?php echo $user_data['dob']; ?></p>
        </th>
        <th id="th">Contact : <p id="p"><?php echo $user_data['contact']; ?></p>
        </th>
        <th id="th">Address : <p id="p"><?php echo $user_data['address']; ?></p>
        </th>
      </tr>


    </table>
  </div>
  <?php include 'Footer.php'; ?>
</body>

</html>