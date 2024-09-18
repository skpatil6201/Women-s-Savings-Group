<?php
include "config.php";


// Initialize variables
$organizationName = $totalAmount = $installmentMonth = '';

// Check if the organization name parameter is set
if(isset($_GET['organization_name'])) {
    $organizationName = $_GET['organization_name'];
    
    // Fetch total amount and installment month for the organization from the database
    $sql = "SELECT loan_amount AS total_amount, installment_months FROM OtherLoans WHERE organization_name = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param("s", $organizationName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $totalAmount = $row['total_amount'];
    $installmentMonth = $row['installment_months'];
    
    $stmt->close();
} else {
    echo "Organization name parameter is not set.";
    exit; // Exit the script if organization name is not provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribute Loan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        /* Style for loan data */
        .loan-form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .action-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 14px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include 'AdminHeader.php'; ?><br>
    <h2>Distribute Loan</h2><br>
    <div class="loan-form">
        <form id="loanForm" method="post">
            <label for="organization_name">Organization Name:</label>
            <input type="text" id="organization_name" name="organization_name" value="<?= htmlspecialchars($organizationName) ?>" readonly>

            <label for="total_amount">Total Amount:</label>
            <input type="text" id="total_amount" name="total_amount" value="<?= htmlspecialchars($totalAmount) ?>" readonly>

            <label for="installment_months">Installment Month:</label>
            <input type="text" id="installment_months" name="installment_month" value="<?= htmlspecialchars($installmentMonth) ?>" readonly>

            <label for="member_id">Member ID:</label>
            <input type="text" id="member_id" name="member_id" required>

            <label for="loan_date">Date:</label>
            <input type="date" id="loan_date" name="loan_date" required>

            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required>

            <label for="money_type">Money Type:</label>
            <select id="money_type" name="money_type">
                <option value="Distibuted Loan">Distibuted Loan</option>
            </select>

            <label for="interest_rate">Interest Rate:</label>
            <input type="text" id="interest_rate" name="interest_rate" required>

            <button type="submit" class="action-btn">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $organizationName = $_POST['organization_name'];
    $memberId = $_POST['member_id'];
    $loanDate = $_POST['loan_date'];
    $amount = $_POST['amount'];
    $moneyType = $_POST['money_type'];
    $interestRate = $_POST['interest_rate'];

    // Check if the requested loan amount exceeds the available loan amount
    if ($amount > $totalAmount) {
        echo "<script>alert('No money available in loan.')</script>";
    } else {
        // Prepare and bind parameters for the SQL query
        $sql = "INSERT INTO OtherLoans (organization_name, memberid, receive_loan_date, receive_loan_amount, type, receive_loan_interest, receive_installment_month) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        $stmt->bind_param("sssssss", $organizationName, $memberId, $loanDate, $amount, $moneyType, $interestRate, $installmentMonth);

        // Execute the query
        if ($stmt->execute()) {
            // Subtract distributed amount from total amount
            $newTotalAmount = $totalAmount - $amount;
            // Update total amount in database for the organization
            $updateSql = "UPDATE OtherLoans SET loan_amount = ? WHERE organization_name = ?";
            $updateStmt = $mysqli->prepare($updateSql);
            if (!$updateStmt) {
                die("Prepare failed: " . $mysqli->error);
            }
            $updateStmt->bind_param("ss", $newTotalAmount, $organizationName);
            if ($updateStmt->execute()) {
                echo "<script>alert('Loan distributed successfully.')</script>";
            } else {
                echo "Error updating total amount: " . $mysqli->error;
            }
            $updateStmt->close();
        } else {
            echo "Error distributing loan: " . $mysqli->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close the database connection
$mysqli->close();
?>
