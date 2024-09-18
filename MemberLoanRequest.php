<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config.php";

    // Retrieve form data
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $member_id = $_POST['member_id'];
    $due_date = $_POST['due_date'];
    $type = $_POST['type']; // New selection data

    // Prepare and bind the SQL statement
    $sql = "INSERT INTO otherloans (RequestLoanAmount, RequestInterestRate,memberid, RequestDate, type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddsss", $loan_amount, $interest_rate, $member_id, $due_date, $type);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Loan application submitted successfully.')</script>";
    } else {
        $error = "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Home</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body style="font-family: Arial, sans-serif;">

    <?php include 'MemberHeader.php'; ?>

    <h2>Apply for a New Loan</h2><br>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($message)) : ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="loan_amount">Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required><br><br>

        <label for="interest_rate">Interest Rate:</label>
        <input type="number" id="interest_rate" name="interest_rate" step="0.01" required><br><br>

        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" required><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br><br>
        <label for="type">Type:</label>
        <select id="type" name="type" type="hidden">
            <option value="Loan Request">New Loan Request</option>
        </select><br><br>

        <input type="submit" value="Apply">
    </form>
    <?php include 'Footer.php'; ?>
</body>

</html>