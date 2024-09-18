<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Home</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <?php include 'MemberHeader.php'; ?>
    <br>
    <h2>View Member Request Status</h2>
    <br>
    <table border="1">
        <thead>
            <tr>
                <
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Start the session to access session variables
            session_start();

            // Check if the member is logged in
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_data']['memberid'])) {
                include "config.php";


                $member_id = $_SESSION['user_data']['memberid'];
                $sql = "SELECT * FROM otherloans WHERE type = 'Loan Request' AND memberid = '$member_id'";
                $result = $conn->query($sql);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["RequestLoanAmount"] . "</td>";
                        echo "<td>" . $row["RequestStutas"] . "</td>"; // Corrected column name
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No Request available...</td></tr>";
                }

                $conn->close();
            } else {
                // If the member is not logged in, redirect them to the login page or handle the situation accordingly
                header("Location: MemberLogin.php"); // Redirect to login page
                // exit; // Stop further execution
            }
            ?>
        </tbody>
    </table>
    <br>

    <?php include 'Footer.php'; ?>
</body>

</html>
