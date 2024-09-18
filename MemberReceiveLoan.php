<?php
session_start();

include "config.php";


// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: Memberlogin.php");
    exit;
}

// Retrieve user data from the session
$user_data = $_SESSION['user_data'];

// Fetch loan data for the logged-in user
$username = $user_data['username']; // Assuming 'username' is the field in 'user_data'
$password = $user_data['password']; // Assuming 'password' is the field in 'user_data'

// Fetch loan data from the database for the logged-in user
$sql = "SELECT * FROM OtherLoans WHERE type='Distibuted Loan' AND memberid = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Include the header
    include 'MemberHeader.php';
    
    // Display loan data if available
    if ($result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th style='padding: 8px; text-align: left;'>Organization Name</th><th style='padding: 8px; text-align: left;'>Member ID</th><th style='padding: 8px; text-align: left;'>Loan Date</th><th style='padding: 8px; text-align: left;'>Amount</th><th style='padding: 8px; text-align: left;'>Money Type</th><th style='padding: 8px; text-align: left;'>Interest Rate</th><th style='padding: 8px; text-align: left;'>Total</th></tr>";
        while ($row = $result->fetch_assoc()) {
            // Calculate the total amount including interest and installment months
            $loanAmount = $row["receive_loan_amount"];
            $interestRate = $row["receive_loan_interest"];
            $installmentMonths = $row["receive_installment_month"]; // Assuming this column exists in your table
            $total = $loanAmount + ($loanAmount * $interestRate / 100) * $installmentMonths;
            
            echo "<tr>";
            echo "<td style='padding: 8px;'>" . $row["organization_name"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["memberid"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["receive_loan_date"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["receive_loan_amount"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["type"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["receive_loan_interest"] . "</td>";
            echo "<td style='padding: 8px;'>" . $total . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    // Close the prepared statement
    $stmt->close();
    
    // Include the footer
    include 'Footer.php';
} else {
    echo "Error executing SQL statement: " . $mysqli->error;
}

?>
