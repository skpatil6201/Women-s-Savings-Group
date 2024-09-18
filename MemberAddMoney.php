<?php
include "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment information from the form
    $saving_memberid = $_POST['memberid'];
    $saving_amount = $_POST['amount'];
    $saving_month = $_POST['month'];
    $saving_date = $_POST['date'];
    $saving_type = $_POST['type']; // Added type retrieval

    // Prepare the SQL statement
    $sql = "INSERT INTO otherloans (memberid, saving_amount, saving_month, saving_date, type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL statement is prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters
    $bind_result = $stmt->bind_param("idsss", $saving_memberid, $saving_amount, $saving_month, $saving_date, $saving_type);

    // Check if the parameters are bound successfully
    if ($bind_result === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the statement
    $execute_result = $stmt->execute();

    // Check if the statement is executed successfully
    if ($execute_result === false) {
        die("Error executing statement: " . $stmt->error);
    }

    // If execution is successful
    echo '<script>alert("Monthly payment added successfully.");</script>';

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Monthly Payment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    button[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .link {
      display: block;
      margin-top: 10px;
      text-align: center;
      text-decoration: none;
      color: #007bff;
    }

    .link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php include 'MemberHeader.php'; ?>

  <div class="container">
    <h2>Add Monthly Payment</h2>
    <form method="post" class="payment-form">
      <div class="form-group">
        <label for="memberid">Member ID:</label>
        <input type="text" id="memberid" name="memberid" required>
      </div>
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" min="0" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="month">Month:</label>
        <input type="text" id="month" name="month" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
      </div>
      
      <div class="form-group">
        <label for="type">Type:</label>
        <select id="type" name="type">
          <option value="New Saving">New Saving</option>
        </select>
      </div>
      <button type="submit" class="btn">Add Payment</button>
    </form>
    <a href="MemberViewProviousHistory.php" class="link">View Previous History</a>
  </div>
  <?php include 'Footer.php'; ?>
</body>
</html>
