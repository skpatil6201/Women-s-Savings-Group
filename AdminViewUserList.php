<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User List</title>
  <link rel="stylesheet" href="style2.css">
</head>
<body>
  
<?php include 'AdminHeader.php'; ?>

<main>
  <section class="user-list">
    <h2>Current Users</h2>
    <table>
      <thead>
        <tr>
          <th>Member ID</th> <!-- Add Member ID column -->
          <th>Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Password</th>
          <th>Date of Birth</th>
          <th>Contact</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
include "config.php";

        // Query to select all users from the database
        $sql = "SELECT * FROM members";
        $result = $conn->query($sql);

        // Check if any users are found
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["memberid"] . "</td>"; 
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["contact"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td><a href='delete_user.php?id=" . $row["memberid"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </section>
</main>

<?php include 'Footer.php'; ?>

<?php
if(isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
    echo "<script>alert('User deleted successfully');</script>";
}
?>

</body>
</html>
