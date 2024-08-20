<?php
require 'db.php'; 

session_start(); 

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

$user_id = (int)$_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic input validation
    if (empty(trim($_POST['username'])) || empty(trim($_POST['email']))) {
        exit;
    }



    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    // Prepare statement to avoid SQL injection
    $stmt = mysqli_prepare($conn, "UPDATE users SET username = ?, email = ? WHERE id = ?");
    if ($stmt === false) {
        echo "MySQL prepare error: " . mysqli_error($conn);
        exit;
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        header("Location: UserProfile.php"); 
        exit;
    } else {
        echo "Error updating profile: " . mysqli_stmt_error($stmt);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>
