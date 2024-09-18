<?php
include "config.php";


// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SQL statement to delete the loan request
    $sql = "DELETE FROM otherloans WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        $success = true; // Set flag to true
    }

    // Close the statement
    $stmt->close();
}

// Retrieve all submitted loan data
$sql = "SELECT * FROM otherloans where type='Loan Request'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Loan Request</title>
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
</head>

<body>

    <?php include 'AdminHeader.php'; ?><br>
    <h2>View Loan Request</h2><br>

    <?php if (isset($success) && $success) : ?>
        <div class="alert alert-success">
            Loan request deleted successfully.
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Loan Amount</th>
                <th>Interest Rate</th>
                <th>Member ID</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["RequestLoanAmount"] . "</td>";
                    echo "<td>" . $row["RequestInterestRate"] . "</td>";
                    echo "<td>" . $row["memberid"] . "</td>";
                    echo "<td>" . $row["RequestDate"] . "</td>";
                    echo "<td>" . $row["RequestStutas"] . "</td>";
                    // Buttons
                    echo "<td>";
                    echo "<button class='action-btn' onclick='confirmDelete(" . $row["id"] . ")'>Delete</button>";
                    echo "<button class='action-btn' onclick='editLoan(" . $row["id"] . ")'>Edit</button>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No submitted loans.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this loan request?")) {
                window.location.href = 'AdminDeleteLoanRequest.php?id=' + id;
            }
        }

        function editLoan(id) {
            // Redirect to edit page for the specified loan request
            window.location.href = 'AdminEditLoanRequest.php?id=' + id;
        }
    </script>

</body>

</html>
