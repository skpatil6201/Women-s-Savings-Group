<?php
session_start();

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $organization_name = $_POST['organization_name'];
    $date = $_POST['date'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $installment_months = $_POST['installment_months'];
    $money_type = $_POST['type']; // Added this line

    // Prepare SQL statement
    $sql = "INSERT INTO OtherLoans (organization_name, date, loan_amount, interest_rate, installment_months, type)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters and execute statement
        $stmt->bind_param("ssdiis", $organization_name, $date, $loan_amount, $interest_rate, $installment_months, $money_type);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows == 1) {
            echo "<script>alert('Loan application submitted successfully.');</script>";
        } else {
            echo "Error: Failed to submit loan application.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Failed to prepare SQL statement.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Other Loan</title>
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
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
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
    <h2>Other Loan </h2>
    <form method="post" >
      <div class="form-group">
        <label for="organization_name">Organization Name:</label>
        <input type="text" id="organization_name" name="organization_name" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="loan_amount">Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required>
      </div>
      <div class="form-group">
        <label for="interest_rate">Interest Rate (%):</label>
        <input type="number" id="interest_rate" name="interest_rate" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="installment_months">Installment Months:</label>
        <input type="number" id="installment_months" name="installment_months" required>
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select id="type" name="type">
          <option value="New Loan">New Loan</option>
        </select>
      </div>
    
      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>
