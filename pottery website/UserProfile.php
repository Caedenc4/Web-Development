<?php include'header.php';



session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}




require 'db.php'; 

session_start(); 


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}


$user_id = $_SESSION['user_id'];


$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result); 




?> 

    <title>User Profile</title>
    <style>

        .form {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            max-width: 400px;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
<div id="templatemo_content"   >
    <h2>User Profile</h2>
    <div class="form">

        <form action="profile.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

          

            <button type="submit">Update Profile</button> <!-- Button to submit form -->
        </form>
    </div>
   <div style="padding: 100px;"></div>
</div>



       <?php include'footer.php'; ?>