<?php
session_start(); 
require 'db.php'; 
 include'header.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

 
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

                 header("Location: index.php");
  exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>


    <style>
       
        .form-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background-color: #f0f0f0; 
        }

    
        label {
            display: block; 
            font-weight: bold; 
            margin-bottom: 10px; 
            color: black;
        }

        input {
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            margin-bottom: 20px; 
        }

        button {
          
            padding: 10px; 
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #45a049; 
        }
    </style>
    <div id="templatemo_content">
 <div class="form-container">
        <div class="form"> 
            <h2>Sign In</h2> 
            <form action="login.php" method="POST"> 
                <label for="username">Username:</label>
                <input type="text" name="username" required>

  

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button> 
            </form>
        </div>
    </div>


</div>

 <?php include'footer.php'; ?>
