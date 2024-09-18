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
    </style>
</head>

<body>

    <?php include 'AdminHeader.php'; ?><br>
    <h2>View Loan Request</h2><br>

    <table>
        <thead>
            <tr>
                <th>Loan Amount</th>
                <th>Interest Rate</th>
                <th>Member ID</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th> <!-- New column for the Edit button -->
            </tr>
        </thead>
        <tbody>
            <?php
include "config.php";

            // Check if the form has been submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve the submitted form data
                $id = $_POST['id'];
                $status = $_POST['status'];

                // Update the status in the database using prepared statement
                $update_query = "UPDATE otherloans SET RequestStutas=? WHERE id=?";
                $stmt = $conn->prepare($update_query);
                if (!$stmt) {
                    die("Error preparing statement: " . $conn->error);
                }
                $stmt->bind_param("si", $status, $id);
                
                if ($stmt->execute()) {
                    // Status updated successfully
                    echo "<script> alert('Status updated successfully.')</script>";
                    if ($status == 'except') {
                        echo "<script>window.location.href = 'AdminSentMoney.php';</script>";
                    }
                } else {
                    // Error updating status
                    echo "Error updating status: " . $conn->error;
                }
            }

            // Retrieve all submitted loan data
            $sql = "SELECT * FROM otherloans WHERE type = 'Loan Request'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["RequestLoanAmount"] . "</td>";
                    echo "<td>" . $row["RequestInterestRate"] . "</td>";
                    echo "<td>" . $row["memberid"] . "</td>";
                    echo "<td>" . $row["RequestDate"] . "</td>";
                    echo "<td>" . $row["RequestStutas"] . "</td>";
                    // Status update form
                    echo "<td>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<select name='status'>";
                    echo "<option value='pending' " . ($row['RequestStatus'] == 'pending' ? 'selected' : '') . ">Pending</option>";
                    echo "<option value='Accept' href='AdminSentMoney.php' " . ($row['RequestStatus'] == 'accept' ? 'selected' : '') . ">Accept</option>";
                    echo "</select>";
                    echo "<input type='submit' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No submitted loans.</td></tr>";
            }

            ?>
        </tbody>
    </table>

</body>

</html>
