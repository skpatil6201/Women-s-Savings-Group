<?php
// Check if the user ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the user ID to prevent SQL injection
    $user_id = $_GET['id'];

    include "config.php";


    // Query to delete user record from the database
    $sql = "DELETE FROM members WHERE memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();
        
        // Close the database connection
        $conn->close();
        
        // Redirect back to the user list page with an alert message
        header("Location: AdminViewUserList.php?deleted=true");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "User ID not provided";
}
?>
