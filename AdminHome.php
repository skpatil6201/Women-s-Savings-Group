<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="AdminHome.css">
  
</head>

<body>
<?php include 'AdminHeader.php'; ?>
  <main>
    <br>
    <section class="overview">
      <h2>Overview</h2><br>
      <p>Welcome to the admin dashboard. Here, you can manage users, resources, and settings for the self-help group project.</p>
    </section>
    <section class="actions">
      <br>

      <h2>Actions</h2>
      <ul>
        <li><a href="AdminOtherAddLoan.php">Add Other Loan</a></li>
        <!-- <li><a href="AdminBankLoan.php">Add Bank Loan</a></li> -->
        <li><a href="AdminSentMoney.php">Sent Money</a></li>
        <li><a href="AdminAddNotification.php">Add Notification</a></li>
        <!-- <li><a href="AdminManageSetting.php">Manage Settings</a></li> -->
      </ul>
    </section>
  </main>
  <?php include 'Footer.php'; ?>
</body>

</html>