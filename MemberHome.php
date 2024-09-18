<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Home</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    main {
      margin: 20px;
    }

    .overview {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 5px;
    }

    .overview h2 {
      color: #333;
    }

    .resources {
      margin-top: 20px;
    }

    .resources h2 {
      color: #333;
    }

    .resources ul {
      list-style-type: none;
      padding: 0;
    }

    .resources ul li {
      margin-bottom: 10px;
    }

    .resources ul li a {
      text-decoration: none;
      color: #0066cc;
    }

    .resources ul li a:hover {
      text-decoration: underline;
    }

    footer {
      margin-top: 20px;
      text-align: center;
    }

    /* Inline CSS */
    .resources ul li {
      font-size: 16px;
    }

    .resources ul li a {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <?php include 'MemberHeader.php'; ?>

  <main>
    <section class="overview">
      <h2>Overview</h2>
      <p>Welcome to the member dashboard. Here, you can access resources, view events, and manage your profile.</p>
    </section>
    <div class="resources">
      
      <ul>
        <li><a href="MemberAddMoney.php">Add Money</a></li>
        <li><a href="MemberLoanRequest.php">Add Loan Request</a></li>
        <li><a href="MemberRequestStatus.php">View Request Status</a></li>
      </ul>
    </div>
  </main>
  <?php include 'Footer.php'; ?>
</body>

</html>
<?php
session_start();

?>
