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

// Check if there's a query parameter to delete a notification
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM notifications WHERE id = ?";
    $delete_stmt = $mysqli->prepare($delete_sql);
    if ($delete_stmt) {
        $delete_stmt->bind_param("i", $delete_id);
        $delete_stmt->execute();
        if ($delete_stmt->affected_rows == 1) {
            $_SESSION['notification'] = 'Notification deleted successfully.';
            header("Location: Notifications.php");
            exit();
        } else {
            $_SESSION['notification'] = 'Error: Failed to delete notification.';
        }
        $delete_stmt->close();
    } else {
        $_SESSION['notification'] = 'Error: Failed to prepare delete statement.';
    }
}

// Fetch notifications from database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Notifications</title>
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
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    .delete-btn {
      background-color: #ff5c5c;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 5px 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php include 'MemberHeader.php'; ?>

<div class="container">
    <h2>View Notifications</h2>
    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Subject</th>
            <th>Description</th>
           
            
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['description']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
    <p>No notifications found.</p>
    <?php endif; ?>
</div>

<?php include 'Footer.php'; ?>


</body>
</html>
