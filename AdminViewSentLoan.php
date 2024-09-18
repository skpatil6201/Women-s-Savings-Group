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

// Fetch loan data from the database
$sql = "SELECT * FROM OtherLoans WHERE type='Distibuted Loan'";
$result = $mysqli->query($sql);

include 'AdminHeader.php'; 
// Display loan data if available
if ($result->num_rows > 0) {
    echo "<div style='margin: 20px;'>";
  
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background-color: #f0f0f0;'><th style='padding: 10px;'>Organization Name</th><th style='padding: 10px;'>Member ID</th><th style='padding: 10px;'>Loan Date</th><th style='padding: 10px;'>Amount</th><th style='padding: 10px;'>Money Type</th><th style='padding: 10px;'>Interest Rate</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td style='padding: 10px;'>" . $row["organization_name"] . "</td>";
        echo "<td style='padding: 10px;'>" . $row["memberid"] . "</td>";
        echo "<td style='padding: 10px;'>" . $row["receive_loan_date"] . "</td>";
        echo "<td style='padding: 10px;'>" . $row["receive_loan_amount"] . "</td>";
        echo "<td style='padding: 10px;'>" . $row["type"] . "</td>";
        echo "<td style='padding: 10px;'>" . $row["receive_loan_interest"] . "</td></tr>";
    }
    echo "</table></div>";
} else {
    echo "No data found.";
}

// Close the database connection
$mysqli->close();
include 'Footer.php';
?>
