<?php
session_start();

include "config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank_name = $_POST['bank_name'];
    $date = $_POST['date'];
    $interest_rate = $_POST['interest_rate'];
    $installment_month = $_POST['installment_month'];
    $loan_amount = $_POST['loan_amount'];

    // Prepare SQL statement
    $sql = "INSERT INTO BankLoans (bank_name, date, interest_rate, installment_month, loan_amount)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        // Bind parameters and execute statement
        $stmt->bind_param("ssdii", $bank_name, $date, $interest_rate, $installment_month, $loan_amount);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows == 1) {
            echo "<script> alert('Loan added successfully.')</script>";
        } else {
            echo "Error: Failed to add loan.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Failed to prepare SQL statement.";
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Loan</title>
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

    form {
      margin-top: 20px;
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
      text-align: center;
    }
  </style>
</head>
<body>
  
<?php include 'AdminHeader.php'; ?>
  <div class="container">
    <h2>Add Loan</h2>
    <form  method="POST">
      <div class="form-group">
        <label for="bank_name">Bank Name:</label>
        <input type="text" id="bank_name" name="bank_name" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="interest_rate">Interest Rate (%):</label>
        <input type="number" id="interest_rate" name="interest_rate" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="installment_month">Installment Months:</label>
        <input type="number" id="installment_month" name="installment_month" required>
      </div>
      <div class="form-group">
        <label for="loan_amount">Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required>
      </div>
      <input type="submit" value="Add Loan">
    </form>
  </div>
</body>
</html>
