<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Payment History</title>
    <style>
        /* Inline CSS for table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
<?php include 'MemberHeader.php'; ?>

<?php
// Start session (assuming you're using sessions for authentication)
session_start();
include "config.php";

// Check if memberid of the logged-in user is set in the session
if(isset($_SESSION['user_data'])) {
    $user_data = $_SESSION['user_data'];
    $memberid = $user_data['memberid'];

    // Query to select payments for the logged-in user
    $sql = "SELECT * FROM otherloans WHERE memberid = '$memberid'";
    $result = $conn->query($sql);

    // Check if there are any payments
    if ($result->num_rows > 0) {
        // Output table header
        echo "<div class='container'>";
        echo "<h2>Monthly Payment History</h2> <br>";
        echo "<table border='1'>";
        echo "<tr><th>Member ID</th><th>Amount</th><th>Month</th><th>Date</th></tr>";
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["memberid"] . "</td>";
            echo "<td>" . $row["saving_amount"] . "</td>";
            echo "<td>" . $row["saving_month"] . "</td>";
            echo "<td>" . $row["saving_date"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='container'>No payments found for the logged-in user.</div>";
    }
} else {
    echo "<div class='container'>No user data found in session. Please log in.</div>";
}

// Close the database connection
$conn->close();
?>

<?php include 'Footer.php'; ?>
</body>
</html>
