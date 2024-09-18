<?php
include "config.php";

// Include AdminHeader.php
include 'AdminHeader.php';

// Fetch all loan data
$sql = "SELECT * FROM OtherLoans WHERE type='New Loan'";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
  echo "<br><h2>View All Loan</h2>";
    echo "<table border='1'>
            <tr>
                <th>Organization Name</th>
                <th>Date</th>
                <th>Loan Amount</th>
                <th>Interest Rate (%)</th>
                <th>Installment Months</th>
                <th>Total Return</th>
                <th>Action</th>
            </tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $total = $row["loan_amount"] + ($row["loan_amount"] * $row["interest_rate"] / 100) * $row["installment_months"];
        echo "<tr>";
        echo "<td>" . $row["organization_name"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["loan_amount"] . "</td>";
        echo "<td>" . $row["interest_rate"] . "</td>";
        echo "<td>" . $row["installment_months"] . "</td>";
        echo "<td>" . $total . "</td>";
        echo "<td>";
        echo "<button class='action-btn' onclick='confirmDelete(" . $row["id"] . ")'>Delete</button>";
        echo "<a class='action-btn' href='AdminDistributeLoan.php?organization_name=" . urlencode($row["organization_name"]) . "'>Distribute</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No loan data found.";
}


include 'Footer.php';
?>


 
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>View Other Loan</title>
      <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        /* Style for loan data */
        .loan-data {
            margin-bottom: 10px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
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
    <script>
         function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this loan request?")) {
                // Send an AJAX request to delete the loan
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "AdminDeleteLoanRequest.php?id=" + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Refresh the page after successful deletion
                        window.location.reload();
                    }
                };
                xhr.send();
            }
        }
    </script>
    </head>
    <body>
      
    </body>
    </html>