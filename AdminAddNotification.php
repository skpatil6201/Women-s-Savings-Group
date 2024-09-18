<?php
session_start();

// Check if there is a notification message
if (isset($_SESSION['notification'])) {
    // Display the notification message
    echo "<script>alert('" . $_SESSION['notification'] . "');</script>";
    // Remove the notification message from session
    unset($_SESSION['notification']);
}

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];

    // Prepare SQL statement
    $sql = "INSERT INTO notifications (title, subject, description)
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters and execute statement
        $stmt->bind_param("sss", $title, $subject, $description);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows == 1) {
            // Set success notification message
            $_SESSION['notification'] = 'Data submitted successfully.';
            // Redirect to a different page
            header("Location: AdminAddNotification.php");
            exit(); // Stop executing the rest of the script
        } else {
            // Set error notification message
            $_SESSION['notification'] = 'Error: Failed to submit data.';
        }

        // Close statement
        $stmt->close();
    } else {
        // Set error notification message
        $_SESSION['notification'] = 'Error: Failed to prepare SQL statement.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      font-weight: bold;
    }
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    textarea {
      height: 150px;
    }
    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<?php include 'AdminHeader.php'; ?>

<div class="container">
    <h2>Add Notification</h2>
    <form method="post">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
      </div>
    <center>  <input type="submit" value="Submit"></center>
    </form>
  </div>
<?php include 'Footer.php'; ?>


</body>
</html>
