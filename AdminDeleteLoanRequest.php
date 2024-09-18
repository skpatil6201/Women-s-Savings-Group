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
        echo "<script>alert('Loan request deleted successfully.')</script>";
    } else {
        echo "<script>alert('Error deleting loan request.')</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect back to the previous page
echo "<script>window.history.back();</script>";
?>
