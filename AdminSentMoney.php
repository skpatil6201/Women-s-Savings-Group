<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $member_id = $_POST["member_id"];
    $amount = $_POST["amount"];
    $type = $_POST["type"];
    $date = $_POST["date"];
    
    include "config.php";

    
    // Prepare SQL statement
    $sql = "INSERT INTO otherloans (memberid, saving_amount, type, saving_payment_date) VALUES ('$member_id', '$amount', '$type', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script> alert('Sent Money Success successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Money</title>
    <style>
        /* Inline CSS styles */
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin: 0 auto;
            max-width: 400px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        select,
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include 'AdminHeader.php'; ?><br>
<center><h2>Sent Money</h2></center>
<br>
<form method="post">
    <label for="member_id">Member ID:</label>
    <input type="text" id="member_id" name="member_id"><br><br>
    
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount"><br><br>
    
    <label for="type">Type:</label>
    <select id="type" name="type">
        <option value="saving">Savings</option>
    </select><br><br>
    
    <label for="date">Date:</label>
    <input type="date" id="date" name="date"><br><br>
    
    <input type="submit" value="Submit">
</form>

<?php include 'Footer.php'; ?>
</body>
</html>
